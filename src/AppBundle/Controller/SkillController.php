<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SkillController extends Controller{
    
    public function listAction($nbskill, $page){
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Skill');
        $newSkill = $repository->getNewSkill();
        
        //Si le formulaire est envoyé, récupère nos valeurs
        
        if(isset($_POST['nbSkill']) && isset($_POST['page'])) {
            $maxResult = $_POST['nbSkill'];
            $firstResult = $_POST['page']*$maxResult;
            $skill = $repository->getSkill($firstResult, $maxResult);
        }
        
        //Sinon on prépare une requête avec des valeurs définies
        
        else {
            $skill = $repository->getSkill($page, $nbSkill);
        }
        
        //Si articles est vide, on affiche une page d'erreur
        
        if(empty($skill)) {
            return $this->render('FilRouge:page404.html.twig', array(
                    'newSkill' => $newSkill
               ));   
        }
        
        //Si articles contient des résultats, on les affiche
        
        return $this->render('FilRouge:Admin:admin.html.twig', array(
                    'skill' => $skill,
                    'newSkill' => $newSkill
               ));
    }
    
    public function detailAction($id){
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Skill');
        $skill = $repository->getSkill($id);
        $newSkill = $repository->getNewSkill();
        
        return $this->render('FilRouge:Admin:admin.html.twig', array(
                    'skill' => $skill,
                    'newSkill' => $newSkill
               ));
    }   
        
    public function addAction(Request $req){
        
        $user = $this->getUser();
        $skill = new Skill();
        $form = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('AppBundle_skill_add')
        ));
        
        $form->handleRequest($req);
        if($form->isValid()) {
            $article->setAuthor($user);
            $em = $this->getDoctrine()->getManager(); 
            if($skill->getId() === null) {
                $em->persist($skill);
                $skill->getImage()->upload();
                $em->persist($skill->getImage());       
            }
            
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('FilRouge_admin')
            );
            
        }
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('FilRouge:Skill');
        $newSkill = $repository->getNewSkill();
        return $this->render('FilRouge:Admin:addskill.html.twig', array(
            'SkillForm' => $form->createView(),
            'newSkill' => $newSkill
        ));        
    }
    
    public function removeAction($id, Request $req){
        
        $skill = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Skill')
                            ->getSkill($id);
        $em = $this->getDoctrine()->getManager();
        
        if($skill === null) {
            throw $this->createNotFoundException('ID' . $id . ' impossible.');
        }
        
        $em->remove($skill);
        
        if($skill->getImage() !== null) {
            $em->remove($skill->getImage());
        }
        
        $em->flush();
        
        return $this->redirect(
            $this->generateUrl('FilRouge_admin')
        );    
    }
    
    public function updateAction($idSkill, Request $req){
        
        $user = $this->getUser();
        $skill = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Skill')
                            ->getSkill($idSkill);
        $em = $this->getDoctrine()->getManager();

        if($skill === null) {
            throw $this->createNotFoundException('ID' . $idSkill . ' impossible.');
        }
        
        $form = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('FilRouge_admin', array('idSkill' => $idSkill))
        ));
        
        $form->handleRequest($req); 
        
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($skill->getId() === null) {
                $skill->setAuthor($user);
                $em->persist($skill);
            }
            
            $em->flush();  
            
            return $this->redirect(
                $this->generateUrl('FilRouge:Admin:admin.html.twig', array('id' => $idSkill))
            );
        }
       
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Skill');
        $skill = $repository->getSkill($idSkill);
        $newSkill = $repository->getNewSkill();
        
        return $this->render('FilRouge:Admin:admin.html.twig', array(
                    'Skill' => $skill,
                    'newSkill' => $newSkill,
                    'skillForm' => $form->createView()
               ));       
    }
}
