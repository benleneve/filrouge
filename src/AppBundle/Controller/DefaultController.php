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
        $myProjects = $repository->findAllProjectsByUserEager($idUser);
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
