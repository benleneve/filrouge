<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
    
    public function indexAction() 
    {
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project');
        $projects = $repository->findAllPojectsEager();
        return $this->render('AppBundle:Default:index.html.twig', array(
            'projects' => $projects
        ));  
    }
    
    public function asideAction() 
    {
        $em = $this->getDoctrine()->getManager();
        $repoMess = $em->getRepository('AppBundle:Message');
        $repoNoti = $em->getRepository('AppBundle:Notification');
        $messages = $repoMess->findAllMessagesEager();
        $notifications = $repoNoti->findAllNotificationsEager();
        return $this->render('AppBundle:Default:layoutaside.html.twig', array(
                'messages' => $messages,
                'notifications' => $notifications
        ));			
    }   
    
}
