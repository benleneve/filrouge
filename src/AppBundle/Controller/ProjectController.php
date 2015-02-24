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

        public function addAction()
        {
            return new Response("Ici, on pourra ajouter un projet");
        }

        public function updateAction($id)
        {
            return new Response("Ici, on pourra mettre à jour les informations du projet " . $id);
        }

        public function removeAction($id)
        {
            return new Response("Ici, on pourra supprimer le projet" . $id);
        }
    }