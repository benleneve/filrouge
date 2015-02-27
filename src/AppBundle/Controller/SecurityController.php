<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller{
    
    public function loginAction(Request $req){
	$session = $req->getSession();
	// Récupère les erreurs d'authentification s'il y en a
	if ($req->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
		$error = $req->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
	} else {
		$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
		$session->remove(SecurityContext::AUTHENTICATION_ERROR);
	}
	return $this->render('AppBundle:Security:login.html.twig', array(
		// Dernier nom d'utilisateur entré par l'utilisateur
		'last_username' => $session->get(SecurityContext::LAST_USERNAME),
		'error'         => $error,
	));
    }   
}
