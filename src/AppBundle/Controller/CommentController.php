<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller{
    
    public function listAction($id) {
        $comments = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Comment')
                        ->findAllCommentsEager($id);
        $project = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($id);
        return $this->render('AppBundle:Project:layoutcomment.html.twig', array(
                    'comments' => $comments,
                    'project' => $project 
            ));
    }

    public function addAction($id, Request $req) {
        $user = $this->getUser();
        $project = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($id);
       
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array('id' => $id)) . '#commentProject'
        ));

        $form->handleRequest($req); 
        if($form->isValid()) {
            $comment->setProject($project);
            $em = $this->getDoctrine()->getManager();
            if($comment->getId() === null) {
                $comment->setAuthor($user);
                $em->persist($comment);
            }
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('filrouge_project_detail', array('id' => $id)) . '#commentProject'
            );
        }
        
        return $this->render('AppBundle:Project:project.html.twig', array(
                    'project' => $project,
                    'commentForm' => $form->createView()
               ));       
    }
    
    public function updateAction($id, $idComment, Request $req) { 
        $comment = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Comment')
                            ->findOneCommentEager($idComment);
        
        $project = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($id);
        
        $em = $this->getDoctrine()->getManager();

        if($comment === null) {
            throw $this->createNotFoundException('ID' . $idComment . ' impossible.');
        }
        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_updateComment', array('id' => $id, 'idComment' => $idComment)) . '#commentProject'
        ));
        
        $form->handleRequest($req); 
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($comment->getId() === null) {
                $em->persist($comment);
            }
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('filrouge_project_detail', array('id' => $id)) . '#commentProject'
            );
        }
        
        return $this->render('AppBundle:Project:project.html.twig', array(
                    'project' => $project,
                    'commentForm' => $form->createView()
               ));       
    }
    
    public function removeAction($id, $idComment, Request $req) {
        $comment = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Comment')
                            ->findOneCommentEager($idComment);
        $em = $this->getDoctrine()->getManager();
        
        if($comment === null) {
            throw $this->createNotFoundException('ID' . $idComment . ' impossible.');
        }
        $em->remove($comment);
        $em->flush();
        
        $project = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($id);
        
        $newComment = new Comment();
        $form = $this->createForm(new CommentType(), $newComment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array('id' => $id)) . '#commentProject'
        ));
        
        return $this->render('AppBundle:Project:project.html.twig', array(
                    'project' => $project,
                    'commentForm' => $form->createView()
               ));   
    }
    
}
