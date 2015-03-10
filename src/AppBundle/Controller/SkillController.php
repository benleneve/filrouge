<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Skill;
use AppBundle\Form\CategoryType;
use AppBundle\Form\SkillType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkillController extends Controller{
    
    public function listAction() {
            $skills = $this->getDoctrine()
                         ->getRepository('AppBundle:Skill')
                         ->findAllSkillEager();
                       
            return $this->render('AppBundle:Admin:layoutadminskill.html.twig', array(
                    'skills' => $skills
            ));
    }
      
    public function addAction(Request $req) {
        $skill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill') . '#adminSkill'
        ));
 
        $formSkill->handleRequest($req);
        if($formSkill->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            if($skill->getId() === null) {
                $em->persist($skill);
            }
            $em->flush();
            return $this->redirect(
                $this->generateUrl('filrouge_admin_list') . '#adminSkill'
            );
        }
        
        return $this->render('AppBundle:Admin:Administration.html.twig', array(
            'skillForm' => $formSkill->createView(),
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
        
        $category = new Category();
        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
        ));
        $formCategory->handleRequest($req);

        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_update_skill', array('id' => $id)) . '#adminSkill'
        ));

        $formSkill->handleRequest($req);
        if($formSkill->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            if($skill->getId() === null) {
                $em->persist($skill);
            }
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('filrouge_admin_list', array('id' => $id)) . '#adminSkill'
            );
        }
        return $this->render('AppBundle:Admin:administration.html.twig', array(
            'skillForm' => $formSkill->createView(),
            'categoryForm' => $formCategory->createView(), 
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
        if(count($skill->getProjectSkills()) === 0 && count($skill->getUserSkills()) === 0) {
            $message = 'La compétence ' . $skill->getName() . ' vient d\'être effacée';
            $em->remove($skill);
            $em->flush();
        } else {
            $message = 'La compétence ' . $skill->getName() . ' ne peut être effacée car elle est utilisée par un utilisateur ou un projet.';
        }
        
        $newSkill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $newSkill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill') . '#adminSkill'
        ));
        $formSkill->handleRequest($req);

        $category = new Category();
        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
        ));
        $formCategory->handleRequest($req);
 
        return $this->render('AppBundle:Admin:Administration.html.twig', array(
                        'messageSkill' => $message,
                        'categoryForm' => $formCategory->createView(),
                        'skillForm' => $formSkill->createView()
            ));
    }
    
}
