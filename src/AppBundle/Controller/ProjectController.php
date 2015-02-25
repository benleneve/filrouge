<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Notification;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\HttpFoundation\Request;

Class ProjectController extends Controller
    {
        public function listAction()
        {
            $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project');
            $projects = $repository->findAllPojectsEager();
            return $this->render('AppBundle:Project:projectslist.html.twig', array(
                    'projects' => $projects
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
                    var_dump($project);
                    $em->persist($project->addStep());
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
            $form = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_update', array('id' => $id))
            ));
            $form->handleRequest($req);
            if($form->isValid()) {
                $em = $this->getDoctrine()->getManager(); 
                if($project->getId() === null) {
                    $em->persist($project);
                }
                $em->flush();  
                return $this->redirect(
                    $this->generateUrl('filrouge_project_detail', array('id' => $id))
                );
            }
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                'projectForm' => $form->createView()
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