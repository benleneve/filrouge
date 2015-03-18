<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use AppBundle\Form\ProjectType;
use AppBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller{
    
    public function listAction($id, $page) {
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
                    'project' => $project,
                    'page' => $page
            ));
    }

    public function addAction($id, $page, Request $req) {
        $user = $this->getUser();
        $project = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($id);
        //Chargement du formulaire Comment
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => $page 
            )) . '#commentProject'
        ));
        $form->handleRequest($req); 
        if($form->isValid()) {
            $comment->setProject($project);
            $em = $this->getDoctrine()->getManager();
            if($comment->getId() === null) {
                $comment->setAuthor($user);
                $em->persist($comment);
                //Ecriture d'un Message pour annoncer un nouveau commentaire
                $content =  ' a posté un commentaire sur votre projet ';
                $message = new Message();
                $message->setSender($user)
                        ->setRecipient($project->getProjectManager())
                        ->setContent($content)
                        ->setProject($project)
                        ->setType(1);
                $em->persist($message);
            }
            $em->flush();
            //Renvoi de la requête soit sur la page project ou addormodifyproject...
            //Après validation du formulaire
            if($page == 'detail') {
                return $this->redirect(
                    $this->generateUrl('filrouge_project_detail', array('id' => $id)) . '#commentProject'
                );  
            } elseif ($page == 'modify') {
                return $this->redirect(
                    $this->generateUrl('filrouge_project_update', array('id' => $id)) . '#commentProject'
                );
            }   
        }
        //Renvoi de la requête soit sur la page project ou addormodifyproject
        if($page == 'detail') {
            return $this->render('AppBundle:Project:project.html.twig', array(
                        'project' => $project,
                        'commentForm' => $form->createView()
                   ));
        } elseif ($page == 'modify') {
            $formProject = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_update', array('id' => $id))
            ));
            $modify = true;
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                        'projectForm' => $formProject->createView(),
                        'project' => $project,
                        'commentForm' => $form->createView(),
                        'modify' => $modify
                   ));
        }       
    }
    
    public function updateAction($id, $idComment, $page, Request $req) { 
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
        //Chargement du formulaire Comment
        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_updateComment', array(
                'id' => $id, 
                'idComment' => $idComment, 
                'page' => $page )) . '#commentProject'
        ));
        //Validation du formulaire et modification du commentaire
        $form->handleRequest($req); 
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($comment->getId() === null) {
                $em->persist($comment);
            }
            $em->flush();
            //Renvoi de la requête soit sur la page project ou addormodifyproject...
            //Après validation du formulaire
            if($page == 'detail') {
                return $this->redirect(
                    $this->generateUrl('filrouge_project_detail', array('id' => $id)) . '#commentProject'
                );  
            } elseif ($page == 'modify') {
                return $this->redirect(
                    $this->generateUrl('filrouge_project_update', array('id' => $id)) . '#commentProject'
                );
            }   
        }
        //Renvoi de la requête soit sur la page project ou addormodifyproject
        if($page == 'detail') {
            return $this->render('AppBundle:Project:project.html.twig', array(
                        'project' => $project,
                        'commentForm' => $form->createView()
                   ));
        } elseif ($page == 'modify') {
            $formProject = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_update', array('id' => $id))
            ));
            $modify = true;
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                        'projectForm' => $formProject->createView(),
                        'project' => $project,
                        'commentForm' => $form->createView(),
                        'modify' => $modify
                   ));
        }
    }
    
    public function removeAction($id, $idComment, $page, Request $req) {
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
        //Effacement du commentaire ciblé
        $em->remove($comment);
        $em->flush();
        //Chargement du formulaire Commetn
        $newComment = new Comment();
        $form = $this->createForm(new CommentType(), $newComment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => $page 
            )) . '#commentProject'
        ));
        //Renvoi de la requête soit sur la page project ou addormodifyproject
        if($page == 'detail') {
            return $this->render('AppBundle:Project:project.html.twig', array(
                        'project' => $project,
                        'commentForm' => $form->createView()
                   ));
        } elseif ($page == 'modify') {
            $formProject = $this->createForm(new ProjectType(), $project, array(
                'action' => $this->generateUrl('filrouge_project_update', array('id' => $id))
            ));
            $modify = true;
            return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
                        'projectForm' => $formProject->createView(),
                        'project' => $project,
                        'commentForm' => $form->createView(),
                        'modify' => $modify
                   ));
        }
    }
    
}
