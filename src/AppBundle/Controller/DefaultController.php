<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Skill;
use AppBundle\Form\CategoryType;
use AppBundle\Form\SkillType;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    
    public function adminAction(Request $req) {
        $skill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill')  . '#adminSkill'
        ));
        $formSkill->handleRequest($req);

        $category = new Category();
        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_add_category')  . '#adminCategory'
        ));
        $formCategory->handleRequest($req);

        return $this->render('AppBundle:Admin:administration.html.twig', array(
                'categoryForm' => $formCategory->createView(),
                'skillForm' => $formSkill->createView()
        ));			
    } 
    
    public function generalConditionAction() {
        return $this->render('AppBundle:Default:generalcondition.html.twig');
    }
    
    public function contactAdminAction() {
        return $this->render('AppBundle:Default:contactadmin.html.twig');
    }
    
    public function sendMailAdminAction($id) {    
        $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
        $mail = $user->getEmail(); 
        
        if(!empty($_POST['title']) && !empty($_POST['message'])) {
            if (preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail)) {
                $message = Swift_Message::newInstance()
                    ->setSubject(htmlspecialchars($_POST['title']))
                    ->setFrom($mail)
                    ->setTo('administrateur@filrouge.com')
                    ->setBody(htmlspecialchars($_POST['message']));
                $this->get('mailer')->send($message);
                $reponse = 'Votre message a bien été envoyé.';
            }
            else {
                $reponse = 'Votre n\'avez pas d\'adresse mail valide dans votre profil.';
            }
        } else {
            $reponse = 'Merci de remplir tous les champs du formulaire.';
        }
 
        return $this->render('AppBundle:Default:contactadmin.html.twig', array(
                'message' => $reponse
        ));
    }
  
}
