<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller {
    
    public function listAction(Request $req) {
        return new Response('Page de liste utilisateur');
    }
    
    public function detailAction($id, Request $req) {
        return new Response('utilisateur' . $id);
    }
    
    public function updateAction($id, Request $req) {
        return new Response('Update utilisateur' . $id);
    }
    
    public function removeAction($id, Request $req) {
        return new Response('Suppression utilisateur' . $id);
    }
}
