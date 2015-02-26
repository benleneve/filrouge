<?php

namespace AppBundle\Controller;

use AppBundle\Form\UserType;
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
    
    public function addAction(Request $req)
        {
            $user = new User();
            $form = $this->createForm(new UserType, $user, array(
                'action' => $this->generateUrl('filrouge_user_add')
            ));
            $form->handleRequest($req);
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager(); 
                if($user->getId() === null) {
                    $em->persist($user);
                    $em->persist($user->getImage());
                }
                $em->flush();  
                return $this->redirect(
                    $this->generateUrl('filrouge_user_list')
                );
            }
            return $this->render('AppBundle:User:addormodifyuser.html.twig', array(
                'userForm' => $form->createView(),
            ));  
        }
    
    public function updateAction($id, Request $req) 
        {
            $user = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:User')
                            ->findOneProjectEager($id);
            
            
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
