<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Skill;
use AppBundle\Form\ProjectType;
use AppBundle\Form\SkillType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkillController extends Controller{
    
      
    public function addAction(Request $req) {
        $skill = new Skill();
        $form = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill')
        ));
        
        $form->handleRequest($req);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            if($skill->getId() === null) {
                $em->persist($skill);
            }
            $em->flush();
            return $this->redirect(
                $this->generateUrl('filrouge_admin_list')
            );
        }
        
        return $this->render('AppBundle:Admin:administration.html.twig', array(
            'skillForm' => $form->createView(),
        ));
    }
    
    public function updateAction($id, Request $req) {
        $skill = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('AppBundle:Skill')
                                ->findOneSkillEager($id);
        $em = $this->getDoctrine()->getManager();
        if($skill === null) {
            throw $this->createNotFoundException('ID ' . $id . ' impossible.');
        }

        $form = $this->createForm(new ProjectType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_update_skill', array('id' => $id))
        ));

        $form->handleRequest($req);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            if($skill->getId() === null) {
                $em->persist($skill);
            }
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('filrouge_admin_list', array('id' => $id))
            );
        }
        return $this->render('AppBundle:Admin:administration.html.twig', array(
            'skillForm' => $form->createView(),
            'skill' => $skill
        ));    
    }
    
    public function removeAction($id, Request $req) {
        $skill = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Skill')
                            ->findOneSkillEager($id);
        $em = $this->getDoctrine()->getManager();
        
        if($skill === null) {
            throw $this->createNotFoundException('ID' . $id . ' impossible.');
        }
        $em->remove($skill);
        $em->flush();
        
        return $this->redirect(
            $this->generateUrl('filrouge_admin_list')
        ); 
    }
    
}
