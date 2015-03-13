<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Message;
use AppBundle\Entity\Notification;
use AppBundle\Entity\Project;
use AppBundle\Entity\Skill;
use AppBundle\Entity\UserProject;
use AppBundle\Form\CategoryType;
use AppBundle\Form\ProjectType;
use AppBundle\Form\SkillType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\HttpFoundation\Request;

Class ProjectController extends Controller
    {
        public function listAction($page) {
            $maxProjects = 5;
            
            $projects = $this->getDoctrine()
                            ->getRepository('AppBundle:Project')
                            ->findAllProjectsPageEager($page, $maxProjects);
            
            $skills = $this->getDoctrine()
                            ->getRepository('AppBundle:Skill')
                            ->findAllSkillEager();
            
            $numberOfProject = count($projects);
            $pagination = array(
                    'page' => $page,
                    'route' => 'filrouge_project_list',
                    'pages_count' => ceil($numberOfProject/$maxProjects),
                    'route_params' => array()
            );
            return $this->render('AppBundle:Project:projectslist.html.twig', array(
                    'projects' => $projects,
                    'skills' => $skills,
                    'pagination' => $pagination
            ));
        }
        
        public function searchAction() {

            if(isset($_POST['nameProject']) && !empty($_POST['nameProject'])) {
                $name = htmlspecialchars($_POST['nameProject']);
            } else {
               $name = 'none'; 
            }
            if($_POST['nameProject'] === 'none') {
                $status = 'none';
            } else {
               $status = htmlspecialchars($_POST['statusProject']); 
            }
            if($_POST['skillProject1'] === 'none') {
                $skill1 = 'none';
            } else {
               $skill1 = htmlspecialchars($_POST['skillProject1']); 
            }
            if($_POST['skillProject2'] === 'none') {
                $skill2 = 'none';
            } else {
               $skill2 = htmlspecialchars($_POST['skillProject2']); 
            }
            if($_POST['skillProject3'] === 'none') {
                $skill3 = 'none';
            } else {
               $skill3 = htmlspecialchars($_POST['skillProject3']); 
            }
            if(isset($_POST['recrutProject'])) {
                $recrut = true;
            } else {
               $recrut = false; 
            }

            $projects = $this->getDoctrine()
                            ->getRepository('AppBundle:Project')
                            ->findSearchProjectsPageEager($name, $status, $skill1, $skill2, $skill3, $recrut);
 
            $skills = $this->getDoctrine()
                            ->getRepository('AppBundle:Skill')
                            ->findAllSkillEager();
            
            return $this->render('AppBundle:Project:projectslist.html.twig', array(
                    'projects' => $projects,
                    'skills' => $skills
            ));
        }

        public function detailAction($id) {
            $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project');
            $project = $repository->findOneProjectEager($id);
            if($project === null) {
                throw $this->createNotFoundException('ID ' . $id . ' impossible.');
            }
            return $this->render('AppBundle:Project:project.html.twig', array(
                    'project' => $project
            ));
        }

        public function addAction(Request $req) {
            $project = new Project();
            $form = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_add')
            ));
            $form->handleRequest($req);
            if($form->isValid()) {
                
                if ($this->get('security.context')->isGranted('ROLE_USER')) {
                    $project->setProjectManager($this->getUser());
                }
                
                $em = $this->getDoctrine()->getManager(); 
                if($project->getId() === null) {
                    $em->persist($project);
                }
                $em->flush();
                
                //Réalisation de la notification création de projet
                $notif = new Notification();
                $message = $project->getProjectManager()->getFirstName() . ' a créé le projet ';
                $notif->setProject($project)
                        ->setType(1)
                        ->setContent($message);
                $em->persist($notif);
                $em->flush();
                
                return $this->redirect(
                    $this->generateUrl('filrouge_project_list')
                );
            }
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                'projectForm' => $form->createView(),
            ));  
        }

        public function updateAction($id, Request $req) {
            $project = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('AppBundle:Project')
                                ->findOneProjectEager($id);
            $em = $this->getDoctrine()->getManager();
            if($project === null) {
                throw $this->createNotFoundException('ID ' . $id . ' impossible.');
            }
            
            //Effacement des steps
            $steps = new ArrayCollection();
            // Crée un tableau contenant les objets Steps courants de BDD
            foreach ($project->getSteps() as $step) {
                $steps->add($step);
            }
            
            //Effacement des projectSkills
            $projectSkills = new ArrayCollection();
            // Crée un tableau contenant les objets ProjectSkill courants de BDD
            foreach ($project->getProjectSkills() as $projectSkill) {
                $projectSkills->add($projectSkill);
            }

            $form = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_update', array('id' => $id))
            ));
            
            $form->handleRequest($req);
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager(); 
                
                // supprime la relation entre la step et le « project »
                foreach ($steps as $step) {
                    if ($project->getSteps()->contains($step) == false) {
                        $em->remove($step);
                    }
                }
                // supprime la relation entre la skill et le « project »
                foreach ($projectSkills as $projectSkill) {
                    if ($project->getProjectSkills()->contains($projectSkill) == false) {
                        $em->remove($projectSkill);
                    }
                }
                
                if($project->getId() === null) {
                    $em->persist($project);
                }
                $em->flush();  
                return $this->redirect(
                    $this->generateUrl('filrouge_project_detail', array('id' => $id))
                );
            }
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                'projectForm' => $form->createView(),
                'project' => $project
            )); 
        }

        public function removeAction($id, Request $req) {
            $project = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project')
                            ->findOneProjectEager($id);
            $em = $this->getDoctrine()->getManager();
            if($project === null) {
                throw $this->createNotFoundException('ID' . $id . ' impossible.');
            }
            $message = 'Le projet ' . $project->getName() . ' vient d\'être effacé';
            $em->remove($project);
            $em->flush();
            
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
                        'messageProject' => $message,
                        'categoryForm' => $formCategory->createView(),
                        'skillForm' => $formSkill->createView()
            ));
        }
        
        public function applyAction($id, $idProjectSkill) {
            
            $project = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project')
                            ->findOneProjectEager($id);
            
            $projectSkill = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:ProjectSkill')
                            ->findOneProjectSkillEager($idProjectSkill);
              
            if($project === null) {
                throw $this->createNotFoundException('ID ' . $id . ' impossible.');
            }
            
            $em = $this->getDoctrine()->getManager();
            
            $user = $this->getUser();
            
            $projectSkill->addApplicants($user->getId());
            
            $skill = $projectSkill->getSkill();
            $name = $projectSkill->getSkill()->getName();
            
            $userProject = new UserProject();
            $userProject->setActive(0);
            $userProject->setSkill($skill);
            $userProject->setProject($project);
            $userProject->setUser($user);
            $em->persist($userProject);
            
            $content = $user->getFirstName() . ' a postulé à votre projet ' . $project->getName();
            
            $message = new Message();
            $message->setSender($user);
            $message->setRecipient($project->getProjectManager());
            $message->setContent($content);
            $message->setType(1);
            $em->persist($message);
            
            $em->flush();
            
            $validation = true;
            
            return $this->render('AppBundle:Project:project.html.twig', array(
                    'project' => $project,
                    'message' => $validation, 
                    'skillName' => $name
            ));
        }
        
        public function acceptAction($id, $idMember) {
      
            $user = $this->getUser();

            $repoUser = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project');
            $project = $repoUser->findOneProjectEager($id);
            
            $repoUserProject = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:UserProject');
            $userProject = $repoUserProject->findOneUserProjectEager($idMember);
            
            $em = $this->getDoctrine()->getManager();
            
            $userProject->setActive(1);  
            $em->persist($userProject);
   
            $content =  'Votre candidature au projet ' . $project->getName() . ' a été acceptée.';
           
            $message = new Message();
            $message->setSender($user);
            $message->setRecipient($userProject->getUSer());
            $message->setContent($content);
            $message->setType(2);
            $em->persist($message);
            
            //Réalisation de la notification création de projet
            $notif = new Notification();
            $message = $userProject->getUser()->getFirstName() . ' a rejoint le projet ';
            $notif->setProject($project)
                    ->setType(2)
                    ->setContent($message);
            $em->persist($notif);
            
            $em->flush();
            
            $form = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_update', array('id' => $id))
            ));
            
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                'projectForm' => $form->createView(),
                'project' => $project,
            ));     
        }    
        
        public function refuseAction($id, $idMember) {
      
            $user = $this->getUser();

            $repoUser = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project');
            $project = $repoUser->findOneProjectEager($id);
            
            $repoUserProject = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:UserProject');
            $userProject = $repoUserProject->findOneUserProjectEager($idMember);
            
            $em = $this->getDoctrine()->getManager();
             
            $em->remove($userProject);
   
            $content =  'Votre candidature au projet ' . $project->getName() . ' a été refusée.';
           
            $message = new Message();
            $message->setSender($user);
            $message->setRecipient($userProject->getUSer());
            $message->setContent($content);
            $message->setType(3);
            $em->persist($message);
            
            $em->flush();
            
            
            $form = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_update', array('id' => $id))
            ));
            
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                'projectForm' => $form->createView(),
                'project' => $project,
            ));     
        }
        
        public function adminAction()
        {  
            $projects = $this->getDoctrine()
                             ->getRepository('AppBundle:Project')
                             ->findAllProjectsEager();

            return $this->render('AppBundle:Admin:layoutadminproject.html.twig', array(
                    'projects' => $projects
            ));
        }
    }