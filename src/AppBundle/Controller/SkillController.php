<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Skill;
use AppBundle\Form\CategoryType;
use AppBundle\Form\SkillType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SkillController extends Controller {
    
    public function listAction() {
        $skills = $this->getDoctrine()
                       ->getRepository('AppBundle:Skill')
                       ->findAllSkillEager();           
        return $this->render('AppBundle:Admin:layoutadminskill.html.twig', array(
                'skills' => $skills
        ));
    }
      
    public function addAction(Request $req) {
        //Chargement du formulaire Skill
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
        //Chargement du formulaire Category
        $category = new Category();
        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
        ));
        //Chargement du formulaire Skill
        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_update_skill', array(
                'id' => $id
            )) . '#adminSkill'
        ));
        //Modification de la Skill
        $formSkill->handleRequest($req);
        if($formSkill->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            if($skill->getId() === null) {
                $em->persist($skill);
            }
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('filrouge_admin_list', array(
                    'id' => $id
                )) . '#adminSkill'
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
        //Effacement de la compétence si elle n'est pas utilisée par un projet ou un utilisateur
        if(count($skill->getProjectSkills()) === 0 
                && count($skill->getUserSkills()) === 0 
                && count($skill->getUserProjectSkills()) === 0) {
            $message = 'La compétence ' . $skill->getName() . ' vient d\'être effacée';
            $em->remove($skill);
            $em->flush();
        } else {
            $message = 'La compétence ' . $skill->getName() . ' ne peut être effacée car elle est utilisée par un utilisateur ou un projet.';
        }
        //Chargement du formulaire Skill
        $newSkill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $newSkill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill') . '#adminSkill'
        ));
        //Chargement du formulaire Category
        $category = new Category();
        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
        ));
        return $this->render('AppBundle:Admin:Administration.html.twig', array(
                        'messageSkill' => $message,
                        'categoryForm' => $formCategory->createView(),
                        'skillForm' => $formSkill->createView()
            ));
    }
    
}
