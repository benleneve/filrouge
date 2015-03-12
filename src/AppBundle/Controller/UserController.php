<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Message;
use AppBundle\Entity\Skill;
use AppBundle\Entity\User;
use AppBundle\Form\CategoryType;
use AppBundle\Form\SkillType;
use AppBundle\Form\UserType;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {
    
    public function listAction($page) 
        {
            $maxUsers = 5;
            
            $users = $this->getDoctrine()
                          ->getRepository('AppBundle:User')
                          ->findAllUsersPageEager($page, $maxUsers);
             
            $skills = $this->getDoctrine()
                           ->getRepository('AppBundle:Skill')
                           ->findAllSkillEager();
             
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
                                        'skills' => $skills,
                                        'pagination' => $pagination
                                        ));
    }
    
    public function detailAction($id) {
            $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
            
            $dateInterval = $user->getBirthDate()->diff(new DateTime());
            $age = $dateInterval->y;
                        
            return $this->render('AppBundle:User:userdetail.html.twig',
                                       array(
                                        'user' => $user,
                                        'age' => $age
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
                            $em->persist($user->getImage());
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
    
    public function removeAction($id, Request $req) 
        {
            $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
               
            $em = $this->getDoctrine()
                       ->getManager();
            
            if(count($user->getManagesProjects()) === 0) {
                $message = $user->getFirstName() . ' ' . $user->getLastName() . ' vient d\'être effacé';
                $em->remove($user);
                if ($user->getImage() !== null)
                    {
                        $em->remove($user->getImage());
                    }
                $em->flush();
            } else {
                $message = $user->getFirstName() . ' ' . $user->getLastName() . ' ne peut être supprimé car il est en charge d\'un projet';
            }
            
            $skill = new Skill();
            $formSkill = $this->createForm(new SkillType(), $skill, array(
                'action' => $this->generateUrl('filrouge_admin_add_skill') . '#adminSkill'
            ));
            $formSkill->handleRequest($req);

            $newCategory = new Category();
            $formCategory = $this->createForm(new CategoryType(), $newCategory, array(
                'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
            ));
            $formCategory->handleRequest($req);
   
            return $this->render('AppBundle:Admin:Administration.html.twig', array(
                        'messageUser' => $message,
                        'categoryForm' => $formCategory->createView(),
                        'skillForm' => $formSkill->createView()
            ));
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
        
    public function adminAction()
    {  
        $users = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findAllUsersEager();
        
        return $this->render('AppBundle:Admin:layoutadminuser.html.twig', array(
                'users' => $users
        ));
    }
           
}
