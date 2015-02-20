<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\HttpFoundation\Request;
use Symfony\component\HttpFoundation\Response;

Class ProjectController extends Controller
    {
        public function listAction()
        {
            return new Response("Ici s'affichera la liste des projets");
        }

        public function detailAction($id)
        {
            return new Response("Ici s'affichera le détail du projet " . $id);
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