<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MessageController extends Controller{
    
    
    public function listAction($page, $id) {
        $maxMessages = 20;

        $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Message');
        $messages = $repository->findAllMessagesPageEager($page, $maxMessages, $id);
        $numberOfMessages = count($messages);
        $pagination = array(
                'page' => $page,
                'route' => 'filrouge_message_list',
                'pages_count' => ceil($numberOfMessages/$maxMessages),
                'route_params' => array('id' => $id)
        );
        return $this->render('AppBundle:Default:message.html.twig', array(
                'messages' => $messages,
                'pagination' => $pagination
        ));
    }
    
    public function removeAction($id, Request $req) {
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Message');
        $em = $this->getDoctrine()->getManager();
        
        $message = $repository->findOneMessageEager($id);

        if($message === null) {
            throw $this->createNotFoundException('ID' . $id . ' impossible.');
        }
        $em->remove($message);
        $em->flush();
        
        $idUser = $this->getUser()->getId();
        
        $maxMessages = 20;
        $page = 1;
        $messages = $repository->findAllMessagesPageEager($page, $maxMessages, $idUser);
        $numberOfMessages = count($messages);
        $pagination = array(
                'page' => $page,
                'route' => 'filrouge_message_list',
                'pages_count' => ceil($numberOfMessages/$maxMessages),
                'route_params' => array('id' => $idUser)
        );
        return $this->render('AppBundle:Default:message.html.twig', array(
                'messages' => $messages,
                'pagination' => $pagination
        ));
        
        
        
        
    }
    
}
