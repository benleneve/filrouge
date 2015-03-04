<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Message;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {
    
    public function listAction($page) 
        {
            $maxUsers = 5;
            
             $repo = $this->getDoctrine()
                          ->getManager()
                          ->getRepository('AppBundle:User');
             
             $users = $repo->findAllUsersEager($page, $maxUsers);
             
             $numberOfUsers = count($users);
             
             $pagination = array(
                    "page" => $page,
                    "route" => "filrouge_user_list",
                    "pages_count" => ceil($numberOfUsers/$maxUsers),
                    "route_params" => array()
                            );
           
            
             
             return $this->render('AppBundle:User:userslist.html.twig',
                                       array(
                                        'users' => $users,
                                        'pagination' => $pagination
                                        ));
    }
    
    public function detailAction($id) {
            $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
                         
          
        
            return $this->render('AppBundle:User:userdetail.html.twig',
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
                $user->setSalt('')
                      ->addRoles('ROLE_USER');
                if($user->getId() === null) 
                    {
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
                'user' => $user
            ));  
        }
    
    public function updateAction($id, Request $req) 
        {
            $user = $this->getDoctrine()
                         ->getManager()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
            
            $em = $this->getDoctrine()
                       ->getManager();
            
            if($user === null) 
                {
                    throw $this->createNotFoundException('ID ' . $id . ' impossible.');
                }
            
            //Effacement des userSkills
            $promotions = new ArrayCollection();
           
            
            // Crée un tableau contenant les objets UserSkill courants de BDD
            foreach ($user->getPromotions() as $promotion) 
                {
                    $promotions->add($promotion);
                }
           
          
            
            //Effacement des userSkills
            $userSkills = new ArrayCollection();
           
            
            // Crée un tableau contenant les objets UserSkill courants de BDD
            foreach ($user->getUserSkills() as $userSkill) 
                {
                    $userSkills->add($userSkill);
                }
        
            $form = $this->createForm(new UserType(), $user, array(
                'action' => $this->generateUrl('filrouge_user_update', array('id' => $id))));
            
            $form->handleRequest($req);
            if($form->isValid()) 
                {
                    $em = $this->getDoctrine()->getManager(); 
                
                     foreach ($promotions as $promotion) 
                        {
                            if ($user->getPromotions()->contains($promotion) == false) 
                                {
                                    $em->remove($promotion);
                                }
                        }
                    // supprime la relation entre la skill et le « user »
                    foreach ($userSkills as $userSkill) 
                        {
                            if ($user->getUserSkills()->contains($userSkill) == false) 
                                {
                                    $em->remove($userSkill);
                                }
                        }
                
                    if($user->getId() === null) 
                        {
                            $em->persist($user);
                        }
                    
                        $em->flush();  
                
                     return $this->redirect($this->generateUrl('filrouge_user_detail', array('id' => $id)));
                }
           
                return $this->render('AppBundle:User:addormodifyuser.html.twig', 
                        array(
                            'userForm' => $form->createView(),
                            'user' => $user
                            )); 
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
        
    public function inviteAction($id)      
        {
            $idProject = $_POST['idProject'];
            $actualUser = $this->getUser();
 
            $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
            
            $project = $this->getDoctrine()
                            ->getRepository('AppBundle:Project')
                            ->findOneProjectEager($idProject);
            
            $em = $this->getDoctrine()->getManager();
                         
            $content =  $actualUser->getFirstName() . ' vous invite à rejoindre le projet ' . $project->getName(); 
            
            $message = new Message();
            $message->setSender($actualUser);
            $message->setRecipient($user);
            $message->setContent($content);
            $message->setType(1);
            $em->persist($message);
            
            $em->flush();
            
            $validation = true;
        
            return $this->render('AppBundle:User:userdetail.html.twig', array(
                        'user' => $user,
                        'message' => $validation
            ));
        }
    
        
}
