<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Notification;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\HttpFoundation\Request;

Class ProjectController extends Controller
    {
        public function listAction($page)
        {
            $maxProjects = 5;
            
            $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project');
            $projects = $repository->findAllPojectsPageEager($page, $maxProjects);
            $numberOfProject = count($projects);
            $pagination = array(
                    'page' => $page,
                    'route' => 'filrouge_project_list',
                    'pages_count' => ceil($numberOfProject/$maxProjects),
                    'route_params' => array()
            );
            return $this->render('AppBundle:Project:projectslist.html.twig', array(
                    'projects' => $projects,
                    'pagination' => $pagination
            ));
        }

        public function detailAction($id)
        {
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

        public function addAction(Request $req)
        {
            $project = new Project();
            $form = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_add')
            ));
            $form->handleRequest($req);
            if($form->isValid()) {
                
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

        public function updateAction($id, Request $req)
        {
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

        public function removeAction($id)
        {
            $project = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project')
                            ->findOneProjectEager($id);
            $em = $this->getDoctrine()->getManager();
            if($project === null) {
                throw $this->createNotFoundException('ID' . $id . ' impossible.');
            }
            $em->remove($project);
            $em->flush();
            return $this->redirect(
                $this->generateUrl('filrouge_project_list')
            );
        }
    }