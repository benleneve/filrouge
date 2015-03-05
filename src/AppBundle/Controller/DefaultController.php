<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
    
    public function indexAction()
    {
        $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project'); 
        $projects = $repository->findAllProjectsEager();
        
        $idUser = $this->getUser()->getId();
        $myProjects = $repository->findAllProjectsByUserEager($idUser);
        
        return $this->render('AppBundle:Default:index.html.twig', array(
                'projects' => $projects,
                'myProjects' => $myProjects
        ));
    }
    
    public function asideAction($nbRecrut, $nbNotif) 
    {
        $em = $this->getDoctrine()->getManager();
        $repoMess = $em->getRepository('AppBundle:Message');
        $repoNoti = $em->getRepository('AppBundle:Notification');
        $messages = $repoMess->findAllMessagesEager($nbRecrut);
        $notifications = $repoNoti->findAllNotificationsEager($nbNotif);
        return $this->render('AppBundle:Default:layoutaside.html.twig', array(
                'messages' => $messages,
                'notifications' => $notifications
        ));			
    }
    
    public function adminAction() 
    {
        return $this->render('AppBundle:Admin:administration.html.twig');			
    } 
    
}
