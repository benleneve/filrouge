<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\HttpFoundation\Request;
use Symfony\component\HttpFoundation\Response;

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
                return $this->redirect(
                    $this->generateUrl('')
                );
            }
            return $this->render('AppBundle:Project:addorupdateproject.html.twig', array(
                'projectForm' => $form->createView(),
            ));  
        }

        public function updateAction($id)
        {
            return new Response("Ici, on pourra mettre à jour les informations du projet " . $id);
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