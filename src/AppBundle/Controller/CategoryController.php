<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Skill;
use AppBundle\Form\CategoryType;
use AppBundle\Form\SkillType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller{
    
    public function listAction() {
            $categories = $this->getDoctrine()
                         ->getRepository('AppBundle:Category')
                         ->findAllCategoriesEager();
                       
            return $this->render('AppBundle:Admin:layoutadmincategory.html.twig', array(
                    'categories' => $categories
            ));
    }
      
    public function addAction(Request $req) {
        $category = new Category();
        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
        ));
 
        $formCategory->handleRequest($req);
        if($formCategory->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            if($category->getId() === null) {
                $em->persist($category);
            }
            $em->flush();
            return $this->redirect(
                $this->generateUrl('filrouge_admin_list') . '#adminCategory'
            );
        }
        
        return $this->render('AppBundle:Admin:Administration.html.twig', array(
            'categoryForm' => $formCategory->createView(),
        ));
    }
    
    public function updateAction($id, Request $req) {
        $category = $this->getDoctrine()
                                ->getManager()
                                ->getRepository('AppBundle:Category')
                                ->findOneCategoryEager($id);
        
        $em = $this->getDoctrine()->getManager();
        
        if($category === null) {
            throw $this->createNotFoundException('ID ' . $id . ' impossible.');
        }
        
        $skill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill')
        ));
        $formSkill->handleRequest($req);

        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_update_category', array('id' => $id)) . '#adminCategory'
        ));

        $formCategory->handleRequest($req);
        if($formCategory->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            if($category->getId() === null) {
                $em->persist($category);
            }
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('filrouge_admin_list', array('id' => $id)) . '#adminCategory'
            );
        }
        return $this->render('AppBundle:Admin:administration.html.twig', array(
            'skillForm' => $formSkill->createView(),
            'categoryForm' => $formCategory->createView(), 
            'category' => $category
        ));    
    }
    
    public function removeAction($id, Request $req) {
        $category = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Category')
                            ->findOneCategoryEager($id);
        $em = $this->getDoctrine()->getManager();
        
        if($category === null) {
            throw $this->createNotFoundException('ID' . $id . ' impossible.');
        }
        
        if(count($category->getSkills()) === 0) {
            $message = 'La catégorie ' . $category->getName() . ' vient d\'être effacée';
            $em->remove($category);
            $em->flush();
        } else {
            $message = 'La catégorie ' . $category->getName() . ' ne peut être effacée car elle contient des compétences';
        }
        
        $skill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill') . '#adminSkill'
        ));
        $formSkill->handleRequest($req);

        $newCategory = new Category();
        $formCategory = $this->createForm(new CategoryType(), $newCategory, array(
            'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
        ));
        $formCategory->handleRequest($req);
 
        return $this->render('AppBundle:Admin:Administration.html.twig', array(
                        'messageCategory' => $message,
                        'categoryForm' => $formCategory->createView(),
                        'skillForm' => $formSkill->createView()
            ));
    }
    
}
