<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Message;
use AppBundle\Entity\Notification;
use AppBundle\Entity\Project;
use AppBundle\Entity\Skill;
use AppBundle\Entity\UserProject;
use AppBundle\Form\CategoryType;
use AppBundle\Form\CommentType;
use AppBundle\Form\ProjectType;
use AppBundle\Form\SkillType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\component\HttpFoundation\Request;

Class ProjectController extends Controller {
       
    public function listAction($page) {
        $maxProjects = 5;
        $projects = $this->getDoctrine()
                        ->getRepository('AppBundle:Project')
                        ->findAllProjectsPageEager($page, $maxProjects);
        $skills = $this->getDoctrine()
                        ->getRepository('AppBundle:Skill')
                        ->findAllSkillEager();
        //Parametrage de la pagination Doctrine
        $numberOfProject = count($projects);
        $pagination = array(
                'page' => $page,
                'route' => 'filrouge_project_list',
                'pages_count' => ceil($numberOfProject/$maxProjects),
                'route_params' => array()
        );
        return $this->render('AppBundle:Project:projectslist.html.twig', array(
                'projects' => $projects,
                'skills' => $skills,
                'pagination' => $pagination
        ));
    }
        
    public function searchAction() {
        //Parametrage de la requête de recherche
        if(isset($_POST['nameProject']) && !empty($_POST['nameProject'])) {
            $name = htmlspecialchars($_POST['nameProject']);
        } else {
           $name = 'none'; 
        }
        if($_POST['statusProject'] === 'none') {
            $status = 'none';
        } else {
           $status = htmlspecialchars($_POST['statusProject']); 
        }
        if($_POST['skillProject1'] === 'none') {
            $skill1 = 'none';
        } else {
           $skill1 = htmlspecialchars($_POST['skillProject1']); 
        }
        if($_POST['skillProject2'] === 'none') {
            $skill2 = 'none';
        } else {
           $skill2 = htmlspecialchars($_POST['skillProject2']); 
        }
        if($_POST['skillProject3'] === 'none') {
            $skill3 = 'none';
        } else {
           $skill3 = htmlspecialchars($_POST['skillProject3']); 
        }
        if(isset($_POST['recrutProject'])) {
            $recrut = true;
        } else {
           $recrut = false; 
        }
        $projects = $this->getDoctrine()
                        ->getRepository('AppBundle:Project')
                        ->findSearchProjectsPageEager($name, $status, $skill1, $skill2, $skill3, $recrut);
        $skills = $this->getDoctrine()
                        ->getRepository('AppBundle:Skill')
                        ->findAllSkillEager();
        return $this->render('AppBundle:Project:projectslist.html.twig', array(
                'projects' => $projects,
                'skills' => $skills
        ));
    }

    public function detailAction($id) {
        $repository = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project');
        $project = $repository->findOneProjectEager($id);
        if($project === null) {
            throw $this->createNotFoundException('ID ' . $id . ' impossible.');
        }
        //Chargement du formulaire Comment
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => 'detail' 
            )) . '#commentProject'
        ));
        return $this->render('AppBundle:Project:project.html.twig', array(
                'project' => $project,
                'commentForm' => $form->createView()
        ));
    }

    public function addAction(Request $req) {
        //Chargement du formulaire Project
        $project = new Project();
        $form = $this->createForm(new ProjectType(), $project, array(
            'action' => $this->generateUrl('filrouge_project_add')
        ));
        $form->handleRequest($req);
        //Vérification et création d'un nouveau projet
        if($form->isValid()) {
            if ($this->get('security.context')->isGranted('ROLE_USER')) {
                $project->setProjectManager($this->getUser());
            }
            $em = $this->getDoctrine()->getManager(); 
            if($project->getId() === null) {
                $em->persist($project);
            }
            $em->flush();
            //Ecriture d'une notification de création de projet
            $notif = new Notification();
            $message = $project->getProjectManager()->getFirstName() . ' a créé le projet ';
            $notif->setProject($project)
                    ->setType(1)
                    ->setContent($message);
            $em->persist($notif);
            $em->flush();
            return $this->redirect(
                $this->generateUrl('filrouge_project_list')
            );
        }
        return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
            'projectForm' => $form->createView()
        ));  
    }

    public function updateAction($id, Request $req) {
        $project = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Project')
                            ->findOneProjectEager($id);
        $em = $this->getDoctrine()->getManager();
        if($project === null) {
            throw $this->createNotFoundException('ID ' . $id . ' impossible.');
        }
        //Effacement des steps associés au projet
        $steps = new ArrayCollection();
        //Création un tableau contenant les objets Steps courants de BDD
        foreach ($project->getSteps() as $step) {
            $steps->add($step);
        }
        //Effacement des projectSkills associés au projet
        $projectSkills = new ArrayCollection();
        //Création un tableau contenant les objets ProjectSkill courants de BDD
        foreach ($project->getProjectSkills() as $projectSkill) {
            $projectSkills->add($projectSkill);
        }
        //Chargement du formulaire Project
        $form = $this->createForm(new ProjectType(), $project, array(
            'action' => $this->generateUrl('filrouge_project_update', array(
                'id' => $id
            ))
        ));
        //Vérification et modification du projet
        $form->handleRequest($req);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            //Supprime la relation entre la step et le « project »
            foreach ($steps as $step) {
                if ($project->getSteps()->contains($step) == false) {
                    $em->remove($step);
                }
            }
            //Supprime la relation entre la skill et le « project »
            foreach ($projectSkills as $projectSkill) {
                if ($project->getProjectSkills()->contains($projectSkill) == false) {
                    $em->remove($projectSkill);
                }
            }
            if($project->getId() === null) {
                $em->persist($project);
            }
            $em->flush();  
            return $this->redirect(
                $this->generateUrl('filrouge_project_detail', array('id' => $id))
            );
        }
        //Chargement du formulaire Comment
        $comment = new Comment();
        $formComment = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => 'modify'
            )) . '#commentProject'
        ));
        //Création d'une variable pour la sécurité du projet
        $modify = true;
        return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
            'projectForm' => $form->createView(),
            'project' => $project,
            'commentForm' => $formComment->createView(),
            'modify' => $modify
        )); 
    }

    public function removeAction($id, Request $req) {
        $project = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($id);
        $em = $this->getDoctrine()->getManager();
        if($project === null) {
            throw $this->createNotFoundException('ID' . $id . ' impossible.');
        }
        $message = 'Le projet ' . $project->getName() . ' vient d\'être effacé';
        $em->remove($project);
        $em->flush();
        //Chargement du formulaire Skill
        $skill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill') . '#adminSkill'
        ));
        //Chargement du formulaire Category
        $newCategory = new Category();
        $formCategory = $this->createForm(new CategoryType(), $newCategory, array(
            'action' => $this->generateUrl('filrouge_admin_add_category') . '#adminCategory'
        ));
        return $this->render('AppBundle:Admin:Administration.html.twig', array(
                    'messageProject' => $message,
                    'categoryForm' => $formCategory->createView(),
                    'skillForm' => $formSkill->createView()
        ));
    }
        
    public function applyAction($id, $idProjectSkill) {
        $project = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($id);
        $projectSkill = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:ProjectSkill')
                        ->findOneProjectSkillEager($idProjectSkill);
        if($project === null) {
            throw $this->createNotFoundException('ID ' . $id . ' impossible.');
        }
        $em = $this->getDoctrine()->getManager();
        //Rajoute l'utilisateur courant dans un Array de postulant
        $user = $this->getUser();
        $projectSkill->addApplicants($user->getId());
        //Récupère la compétence ainsi que son nom
        $skill = $projectSkill->getSkill();
        $name = $projectSkill->getSkill()->getName();
        //Ecriture en BDD d'un nouveau UserProject
        $userProject = new UserProject();
        $userProject->setActive(0)
                ->setSkill($skill)
                ->setProject($project)
                ->setUser($user);
        $em->persist($userProject);
        //Ecriture d'un message pour le chef de projet
        $content = ' a postulé à votre projet ';
        $message = new Message();
        $message->setSender($user)
                ->setRecipient($project->getProjectManager())
                ->setContent($content)
                ->setProject($project)
                ->setType(1);
        $em->persist($message);
        $em->flush();
        //Création d'une variable permettant d'afficher un message dans project
        $validation = true;
        //Chargement du formulaire Comment
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => 'detail'
            )) . '#commentProject'
        ));
        return $this->render('AppBundle:Project:project.html.twig', array(
                'project' => $project,
                'message' => $validation, 
                'skillName' => $name,
                'commentForm' => $form->createView()
        ));
    }
        
    public function acceptAction($id, $idMember) {
        $user = $this->getUser();
        $repoUser = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project');
        $project = $repoUser->findOneProjectEager($id);
        $repoUserProject = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:UserProject');
        $userProject = $repoUserProject->findOneUserProjectEager($idMember);
        $em = $this->getDoctrine()->getManager();
        //Passage d'un candidat en actif dans UserProject
        $userProject->setActive(1);  
        $em->persist($userProject);
        //Ecriture d'un message de validation pour le postulant
        $content =  'Votre candidature a été acceptée pour le projet ';
        $message = new Message();
        $message->setSender($user)
                ->setRecipient($userProject->getUser())
                ->setContent($content)
                ->setProject($project)
                ->setType(2);
        $em->persist($message);
        //Ecriture de la notification création de projet
        $notif = new Notification();
        $message = $userProject->getUser()->getFirstName() . ' a rejoint le projet ';
        $notif->setProject($project)
                ->setType(2)
                ->setContent($message);
        $em->persist($notif);
        $em->flush();
        //Chargement du formulaire Project
        $form = $this->createForm(new ProjectType(), $project, array(
            'action' => $this->generateUrl('filrouge_project_update', array(
                'id' => $id
            ))
        ));
        //Chargement du formulaire Comment
        $comment = new Comment();
        $formComment = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => 'modify'
            )) . '#commentProject'
        ));
        //Création d'une variable pour la sécurité du projet
        $modify = true;
        return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
            'projectForm' => $form->createView(),
            'project' => $project,
            'modify' => $modify,
            'commentForm' => $formComment->createView()
        ));     
    }    
        
    public function refuseAction($id, $idMember) {
        $user = $this->getUser();
        $repoUser = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project');
        $project = $repoUser->findOneProjectEager($id);
        $repoUserProject = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:UserProject');
        $userProject = $repoUserProject->findOneUserProjectEager($idMember);
        $em = $this->getDoctrine()->getManager();
        //Effacement du UserProject d'un candidat refusé
        $em->remove($userProject);
        //Ecriture d'un message de refus pour le candidat  
        $content =  'Votre candidature a été refusée pour le projet';
        $message = new Message();
        $message->setSender($user)
                ->setRecipient($userProject->getUser())
                ->setContent($content)
                ->setProject($project)
                ->setType(3);
        $em->persist($message);
        $em->flush();
        //Chargement du formulaire Project
        $form = $this->createForm(new ProjectType(), $project, array(
            'action' => $this->generateUrl('filrouge_project_update', array(
                'id' => $id
            ))
        ));
        //Chargement du formulaire Comment
        $comment = new Comment();
        $formComment = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => 'modify'
            )) . '#commentProject'
        ));
        //Création d'une variable pour la sécurité du projet
        $modify = true;
        return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
            'projectForm' => $form->createView(),
            'project' => $project,
            'modify' => $modify,
            'commentForm' => $formComment->createView()
        ));     
    }
        
    public function fireAction($id, $idMember) {
        $repoUser = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:Project');
        $project = $repoUser->findOneProjectEager($id);
        $repoUserProject = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('AppBundle:UserProject');
        $userProject = $repoUserProject->findOneUserProjectEager($idMember);
        $em = $this->getDoctrine()->getManager();
        //Effacement du UserProject d'un candidat licencié
        $em->remove($userProject);
        $em->flush();
        //Chargement du formulaire Project
        $form = $this->createForm(new ProjectType(), $project, array(
            'action' => $this->generateUrl('filrouge_project_update', array(
                'id' => $id
            ))
        ));
        //Chargement du formulaire Comment
        $comment = new Comment();
        $formComment = $this->createForm(new CommentType(), $comment, array(
            'action' => $this->generateUrl('filrouge_project_addComment', array(
                'id' => $id, 
                'page' => 'modify'
            )) . '#commentProject'
        ));
        //Création d'une variable pour la sécurité du projet
        $modify = true;
        return $this->render('AppBundle:Project:addormodifyproject.html.twig', array(
            'projectForm' => $form->createView(),
            'project' => $project,
            'modify' => $modify,
            'commentForm' => $formComment->createView()
        ));     
    }
        
    public function adminAction() {  
        $projects = $this->getDoctrine()
                         ->getRepository('AppBundle:Project')
                         ->findAllProjectsEager();
        return $this->render('AppBundle:Admin:layoutadminproject.html.twig', array(
                'projects' => $projects
        ));
    }
}