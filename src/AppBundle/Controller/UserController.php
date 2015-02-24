<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {
    
    public function listAction() 
        {
             $repo = $this->getDoctrine()
                          ->getManager()
                          ->getRepository('AppBundle:User');
           
             $user = $repo->findAllUsersEager();
             
             return $this->render('AppBundle:User:userslist.html.twig',
                                       array(
                                        'users' => $user
                                        ));
    }
    
    public function detailAction($id) {
            $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
          
        
            return $this->render('AppBundle:User:userDetail.html.twig',
                                       array(
                                        'user' => $user
                                        ));
    }
    
    public function updateAction($id, Request $req) 
        {
            $prod = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);


            $action = $this->generateUrl('filrouge_user_update', array('id' => $id));

           // return $this->handleForm($user, $action, $req);  
            
            return new Response("Bientôt, il y aura un super formulaire ici :) ");
        }
    
    public function removeAction($id) 
        {
            $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
               
            $em = $this->getDoctrine()
                       ->getManager();
            
            $em->remove($user);
           
            if ($user->getImage() !== null)
                {
                    $em->remove($user->getImage());
                }
            $em->flush();
            
            $url = $this->generateUrl('filrouge_user_list');
                            
            return $this->redirect($url);
        }
    
        
}
