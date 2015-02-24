<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller{
    
    public function listAction($nbcategory, $page){
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Category');
        $newCategory = $repository->getNewCategory();
        
        //Si le formulaire est envoyé, récupère nos valeurs
        
        if(isset($_POST['nbCategory']) && isset($_POST['page'])) {
            $maxResult = $_POST['nbCategory'];
            $firstResult = $_POST['page']*$maxResult;
            $category = $repository->getCategory($firstResult, $maxResult);
        }
        
        //Sinon on prépare une requête avec des valeurs définies
        
        else {
            $category = $repository->getCategory($page, $nbcategory);
        }
        
        //Si articles est vide, on affiche une page d'erreur
        
        if(empty($category)) {
            return $this->render('FilRouge:page404.html.twig', array(
                    'newCategory' => $newCategory
               ));   
        }
        
        //Si articles contient des résultats, on les affiche
        
        return $this->render('FilRouge:Admin:admin.html.twig', array(
                    'category' => $category,
                    'newCategory' => $newCategory
               ));
    }
    
    public function detailAction($id){
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Category');
        $category = $repository->getCategory($id);
        $newCategory = $repository->getNewCategory();
        
        return $this->render('FilRouge:Admin:admin.html.twig', array(
                    'category' => $category,
                    'newCategory' => $newCategory
               ));
    }   
        
    public function addAction(Request $req){
        
        $user = $this->getUser();
        $category = new Category();
        $form = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('AppBundle_category_add')
        ));
        
        $form->handleRequest($req);
        if($form->isValid()) {
            $category->setAuthor($user);
            $em = $this->getDoctrine()->getManager(); 
            if($category->getId() === null) {
                $em->persist($category);
                $category->getImage()->upload();
                $em->persist($category->getImage());       
            }
            
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('FilRouge_admin')
            );
            
        }
        
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('FilRouge:Category');
        $newCategory = $repository->getNewCategory();
        return $this->render('FilRouge:Admin:addcategory.html.twig', array(
            'CategoryForm' => $form->createView(),
            'newCategory' => $newCategory
        ));        
    }
    
    public function removeAction($id, Request $req){
        
        $category = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Category')
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
    
    public function updateAction($idCategory, Request $req){
        
        $user = $this->getUser();
        $category = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Category')
                            ->getSkill($idCategory);
        $em = $this->getDoctrine()->getManager();

        if($category === null) {
            throw $this->createNotFoundException('ID' . $idCategory . ' impossible.');
        }
        
        $form = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('FilRouge_admin', array('idCategory' => $idCategory))
        ));
        
        $form->handleRequest($req); 
        
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($category->getId() === null) {
                $category->setAuthor($user);
                $em->persist($category);
            }
            
            $em->flush();  
            
            return $this->redirect(
                $this->generateUrl('FilRouge:Admin:admin.html.twig', array('id' => $idCategory))
            );
        }
       
        $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Category');
        $category = $repository->getCategory($idCategory);
        $newCategory = $repository->getNewCategory();
        
        return $this->render('FilRouge:Admin:admin.html.twig', array(
                    'Category' => $category,
                    'newCategory' => $newCategory,
                    'categoryForm' => $form->createView()
               ));       
    }
}
