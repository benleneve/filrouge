<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
    
    public function indexAction($pageMP, $page)
    {
        $maxProjects = 5;
            
        $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project');
        $projects = $repository->findAllProjectsPageEager($page, $maxProjects);
        $numberOfProject = count($projects);
        
        $idUser = $this->getUser()->getId();
        $myProjects = $repository->findAllProjectsByUserPageEager($pageMP, $maxProjects, $idUser);
        $numberOfMyProject = count($myProjects);
        
        $pagination = array(
                'page' => $page,
                'pageMP' => $pageMP,
                'route' => 'filrouge_homepage',
                'pages_count' => ceil($numberOfProject/$maxProjects),
                'pagesMP_count' => ceil($numberOfMyProject/$maxProjects),
                'route_params' => array()
        );
        
        return $this->render('AppBundle:Default:index.html.twig', array(
                'projects' => $projects,
                'pagination' => $pagination,
                'myProjects' => $myProjects
        ));
    }

    public function asideAction($id) 
    {
        $em = $this->getDoctrine()->getManager();
        $repoMess = $em->getRepository('AppBundle:Message');
        $repoNoti = $em->getRepository('AppBundle:Notification');
        $messages = $repoMess->findLastMessagesByUserEager($id);
        $notifications = $repoNoti->findLastNotificationsEager();
        return $this->render('AppBundle:Default:layoutaside.html.twig', array(
                'messages' => $messages,
                'notifications' => $notifications
        ));			
    }
    
    public function listNotificationAction($page) {
        $maxNotifications = 20;

        $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Notification');
        $notifications = $repository->findAllMessagesPageEager($page, $maxNotifications);
        $numberOfNotifications = count($notifications);
        $pagination = array(
                'page' => $page,
                'route' => 'filrouge_notification',
                'pages_count' => ceil($numberOfNotifications/$maxNotifications),
                'route_params' => array()
        );
        return $this->render('AppBundle:Default:notification.html.twig', array(
                'notifications' => $notifications,
                'pagination' => $pagination
        ));
    }
    
    public function adminAction() {
        return $this->render('AppBundle:Admin:administration.html.twig');			
    } 
    
    public function generalConditionAction() {
        return $this->render('AppBundle:Default:generalcondition.html.twig');
    }
    
}
