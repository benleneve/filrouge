<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Image;
use AppBundle\Entity\Message;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\Skill;
use AppBundle\Entity\User;
use AppBundle\Form\CategoryType;
use AppBundle\Form\SkillType;
use AppBundle\Form\UserType;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {
    
    public function listAction($page) {
        $maxUsers = 5;
        $users = $this->getDoctrine()
                      ->getRepository('AppBundle:User')
                      ->findAllUsersPageEager($page, $maxUsers);
        $skills = $this->getDoctrine()
                       ->getRepository('AppBundle:Skill')
                       ->findAllSkillEager();
        //Parametrage de la pagination Doctrine
        $numberOfUsers = count($users);
        $pagination = array(
                "page" => $page,
                "route" => "filrouge_user_list",
                "pages_count" => ceil($numberOfUsers/$maxUsers),
                "route_params" => array()
        );
        return $this->render('AppBundle:User:userslist.html.twig', array(
            'users' => $users,
            'skills' => $skills,
            'pagination' => $pagination
        ));
    }
    
    public function searchAction() {
        //Parametrage de la requête de recherche
        if(isset($_POST['nameUser']) && !empty($_POST['nameUser'])) {
            $name = htmlspecialchars($_POST['nameUser']);
        } else {
           $name = 'none'; 
        }
        if($_POST['skillUser1'] === 'none') {
            $skill1 = 'none';
        } else {
           $skill1 = htmlspecialchars($_POST['skillUser1']); 
        }
        if($_POST['skillUser2'] === 'none') {
            $skill2 = 'none';
        } else {
           $skill2 = htmlspecialchars($_POST['skillUser2']); 
        }
        if($_POST['skillUser3'] === 'none') {
            $skill3 = 'none';
        } else {
           $skill3 = htmlspecialchars($_POST['skillUser3']); 
        }
        if(isset($_POST['statusUser'])) {
            $status = true;
        } else {
           $status = false; 
        }
        $users = $this->getDoctrine()
                        ->getRepository('AppBundle:User')
                        ->findSearchUsersPageEager($name, $status, $skill1, $skill2, $skill3);
        $skills = $this->getDoctrine()
                        ->getRepository('AppBundle:Skill')
                        ->findAllSkillEager();
        return $this->render('AppBundle:User:userslist.html.twig', array(
                'users' => $users,
                'skills' => $skills
        ));
    }
    
    public function detailAction($id) {
        $user = $this->getDoctrine()
                     ->getRepository('AppBundle:User')
                     ->findOneUserEager($id);
        //Calcul de l'âge d'un utilisateur
        $dateInterval = $user->getBirthDate()->diff(new DateTime());
        $age = $dateInterval->y;
        return $this->render('AppBundle:User:userdetail.html.twig', array(
            'user' => $user,
            'age' => $age
        ));
    }
    
    public function addAction(Request $req) {
        //Chargement du formulaire User
        $user = new User();
        $form = $this->createForm(new UserType, $user, array(
            'action' => $this->generateUrl('filrouge_user_add')
        ));
        //Validation et ajout d'un User en BDD
        $form->handleRequest($req);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            $user->setSalt('')->addRoles('ROLE_USER');
            if($user->getId() === null) {
                $em->persist($user);
                $em->persist($user->getImage());
            }
            $em->flush();  
            return $this->redirect(
                 $this->generateUrl('filrouge_user_list')
            );
        }
        return $this->render('AppBundle:User:addormodifyuser.html.twig', array(
            'userForm' => $form->createView(),
            'user' => $user
        ));  
    }
    
    public function updateAction($id, Request $req) {
        $user = $this->getDoctrine()
                     ->getRepository('AppBundle:User')
                     ->findOneUserEager($id);
        $em = $this->getDoctrine()
                   ->getManager();
        if($user === null) {
            throw $this->createNotFoundException('ID ' . $id . ' impossible.');
        }
        //Effacement des userSkills
        $promotions = new ArrayCollection();           
        // Crée un tableau contenant les objets UserSkill courants de BDD
        foreach ($user->getPromotions() as $promotion) {
            $promotions->add($promotion);
        }
        //Effacement des userSkills
        $userSkills = new ArrayCollection();
        // Crée un tableau contenant les objets UserSkill courants de BDD
        foreach ($user->getUserSkills() as $userSkill) {
            $userSkills->add($userSkill);
        }
        //Chargement du formulaire User
        $form = $this->createForm(new UserType(), $user, array(
            'action' => $this->generateUrl('filrouge_user_update', array(
                'id' => $id
            ))
        ));
        //Modification d'un User
        $form->handleRequest($req);
        if($form->isValid()) {
            $em = $this->getDoctrine()->getManager(); 
            //Supprime la relation entre la promotion et le « user »
            foreach ($promotions as $promotion) {
                if ($user->getPromotions()->contains($promotion) == false) {
                    $em->remove($promotion);
                }
            }
            //Supprime la relation entre la skill et le « user »
            foreach ($userSkills as $userSkill) {
                if ($user->getUserSkills()->contains($userSkill) == false) {
                    $em->remove($userSkill);
                }
            }
            if($user->getId() === null) {
                $em->persist($user);
                $em->persist($user->getImage());
            }
            $em->flush();  
            return $this->redirect($this->generateUrl('filrouge_user_detail', array(
                'id' => $id
            )));
        }
        return $this->render('AppBundle:User:addormodifyuser.html.twig', array(
                'userForm' => $form->createView(),
                'user' => $user
        )); 
    }
    
    public function removeAction($id, Request $req) {
        $user = $this->getDoctrine()
                     ->getRepository('AppBundle:User')
                     ->findOneUserEager($id);
        $em = $this->getDoctrine()->getManager();
        if($user === null) {
            throw $this->createNotFoundException('ID' . $id . ' impossible.');
        }
        $actualUser = $this->getUser();
        //Effacement d'un User s'il n'est pas en charge d'un project
        if($this->get('security.context')->isGranted('ROLE_SUPER_ADMIN')) {
            if($user != $actualUser) {
                if(count($user->getManagesProjects()) === 0) {
                    $message = $user->getFirstName() . ' ' . $user->getLastName() . ' vient d\'être effacé.';
                    $em->remove($user);
                    if ($user->getImage() !== null) {
                        $em->remove($user->getImage());
                    }
                    $em->flush();
                } else {
                    $message = $user->getFirstName() . ' ' . $user->getLastName() . ' ne peut être supprimé car il est en charge d\'un projet.';
                }
            } else {
                $message = 'Vous n\'avez pas les droits nécessaires pour supprimer ce profil.';
            }  
        }
        else if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            if(in_array("ROLE_SUPER_ADMIN", $user->getRoles())) {
                $message = $user->getFirstName() . ' ' . $user->getLastName() . ' ne peut être supprimé car il est SuperAdmin.';
            } else {
                if(in_array("ROLE_ADMIN", $user->getRoles())) {
                    $message = 'Vous n\'avez pas les droits nécessaires pour supprimer ce profil.';
                }
                else {
                    if($user != $actualUser) {
                        if(count($user->getManagesProjects()) === 0) {
                            $message = $user->getFirstName() . ' ' . $user->getLastName() . ' vient d\'être effacé.';
                            $em->remove($user);
                            if ($user->getImage() !== null) {
                                $em->remove($user->getImage());
                            }
                            $em->flush();
                        } else {
                            $message = $user->getFirstName() . ' ' . $user->getLastName() . ' ne peut être supprimé car il est en charge d\'un projet.';
                        }
                    } else {
                        $message = 'Vous n\'avez pas les droits nécessaires pour supprimer ce profil.';
                  }  
                }   
            }
        }
        else {
            $message = 'Vous n\'avez pas les droits nécessaires pour supprimer ce profil.'; 
        }
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
                    'messageUser' => $message,
                    'categoryForm' => $formCategory->createView(),
                    'skillForm' => $formSkill->createView()
        ));
    }
        
    public function inviteAction($id) {
        $idProject = $_POST['idProject'];
        $actualUser = $this->getUser();
        $user = $this->getDoctrine()
                     ->getRepository('AppBundle:User')
                     ->findOneUserEager($id);
        $project = $this->getDoctrine()
                        ->getRepository('AppBundle:Project')
                        ->findOneProjectEager($idProject);
        $em = $this->getDoctrine()->getManager();
        //Ecriture du message d'invitation pour le possible candidat
        $content = ' vous invite à rejoindre le projet '; 
        $message = new Message();
        $message->setSender($actualUser)
                ->setRecipient($user)
                ->setContent($content)
                ->setProject($project)
                ->setType(1);
        $em->persist($message);
        $em->flush();
        //Creation d'une variable pour l'affichage d'un message
        $validation = true;
        //Calcul de l'âge du User Renvoyé
        $dateInterval = $user->getBirthDate()->diff(new DateTime());
        $age = $dateInterval->y;
        return $this->render('AppBundle:User:userdetail.html.twig', array(
                    'user' => $user,
                    'message' => $validation,
                    'age' => $age
        ));
    }
        
    public function adminAction() {  
        $users = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findAllUsersEager();
        
        return $this->render('AppBundle:Admin:layoutadminuser.html.twig', array(
                'users' => $users
        ));
    }
    
    public function sendMailAction($id) {    
        $user = $this->getDoctrine()
                         ->getRepository('AppBundle:User')
                         ->findOneUserEager($id);
        $mailUser = $user->getEmail(); 
        $mailSender = $this->getUser()->getEmail();
        //Création du mail
        if(!empty($_POST['title']) && !empty($_POST['message'])) {
            if (preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mailUser)) {
                if (preg_match("#^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mailSender)) {
                    $message = Swift_Message::newInstance()
                        ->setSubject(htmlspecialchars($_POST['title']))
                        ->setFrom($mailSender)
                        ->setTo($mailUser)
                        ->setBody(htmlspecialchars($_POST['message']));
                    $this->get('mailer')->send($message);
                    $reponse = 'Votre message a bien été envoyé.';
                }
                else {
                    $reponse = 'Votre n\'avez pas d\'adresse mail valide dans votre profil.';
                }
            }
            else {
                $reponse = 'Votre correspondant ne possède pas d\'adresse mail valide dans son profil.';
            }
        } else {
            $reponse = 'Merci de remplir tous les champs du formulaire.';
        }
        //Calcul de l'âge du User Renvoyé
        $dateInterval = $user->getBirthDate()->diff(new DateTime());
        $age = $dateInterval->y;
        return $this->render('AppBundle:User:userdetail.html.twig', array(
                'messageMail' => $reponse,
                'user' => $user,
                'age' => $age
        ));
    }
    
    public function importCsvAction(Request $req) {
        if ($req->getMethod() == 'POST') {
            foreach($this->getRequest()->files as $file) {
                if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
                    //Initialisation des variables
                    $cpt = 0;
                    $problem = false;
                    $userExist = false;
                    while(($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        //Vérification pour voir si le fichier csv contient le bon nombre de colonne
                        if(count($row) === 12) {
                            //On exclut la première ligne avec les infos
                            if ($cpt !== 0) {
                                //Récupération de l'entité School
                                if(strtoupper(htmlspecialchars($row[1])) === 'NANTES') {
                                    $name = 'Nantes';
                                } 
                                elseif (strtoupper(htmlspecialchars($row[1])) === 'RENNES') {
                                    $name = 'Rennes';    
                                }
                                elseif (strtoupper(htmlspecialchars($row[1])) === 'ANGERS') {
                                    $name = 'Angers';
                                }
                                $school =  $this->getDoctrine()
                                                    ->getRepository('AppBundle:School')
                                                    ->findOneSchoolEager($name);  
                                //Création d'une entité Image
                                $image = new Image();
                                $image->setUrl('bundles/app/images/avatar.png')
                                      ->setAlt('Image du profil');
                                //Création d'une entité Promotion
                                $promotion = new Promotion();
                                $promotion->setName(htmlspecialchars($row[2]))
                                      ->setYear(htmlspecialchars($row[3]))
                                      ->setSchool($school);
                                //Création et remplissage d'une entité Promotion
                                $user = new User();
                                $username = strtolower(htmlspecialchars($row[5])).'.'.strtolower(htmlspecialchars($row[2]));
                                $user->setFirstName(htmlspecialchars($row[5]))
                                    ->setLastName(htmlspecialchars($row[4]))
                                    ->setEmail(htmlspecialchars($row[10]))
                                    ->setAddress(htmlspecialchars($row[6]))
                                    ->setPostCode(htmlspecialchars($row[7]))
                                    ->setCity(htmlspecialchars($row[8]))
                                    ->setPhone(str_replace(' ', '', htmlspecialchars($row[9])))
                                    ->setBirthDate(\DateTime::createFromFormat('d/m/Y', $row[11]))
                                    ->setUsername($username)
                                    ->setPassword('userpass')
                                    ->setSalt('')
                                    ->setImage($image)
                                    ->addRoles('ROLE_USER')
                                    ->addPromotion($promotion)
                                    ->setAvailability(false)
                                    ->setDispoAddress(false)
                                    ->setDispoBirth(false)
                                    ->setDispoEmail(false)
                                    ->setDispoPhone(false);
                                $em = $this->getDoctrine()->getManager();
                                $em->persist($user);
                                //On essaie d'envoyer le résultat en BDD
                                try{
                                    $em->flush();
                                    $problem = false;
                                }
                                //Si erreur on envoie un message
                                catch(\Exception $e){
                                    error_log($e->getMessage());
                                    $problem = true;
                                    $userExist = true;
                                    break;
                                }
                            }
                            else {
                                $problem = true;
                            }
                            $cpt ++;    
                        }
                        else {
                            $problem = true;
                        }
                    }
                }
                fclose($handle); 
            }
        }
        else {
            $problem = true;  
        }
        if ($problem) {
            if($userExist) {
               $messageCsv = 'Votre fichier CSV ne peut être importé car il contient des profils déjà renseignés.'; 
            } else {
               $messageCsv = 'Votre fichier CSV ne peut être importé car il ne respecte pas le format attendu.'; 
            }
        } else {
            $messageCsv = $cpt-1 . ' profil(s) ont été importé(s) dans l\'application.';
        }
        //Chargement du formulaire Skill
        $skill = new Skill();
        $formSkill = $this->createForm(new SkillType(), $skill, array(
            'action' => $this->generateUrl('filrouge_admin_add_skill')  . '#adminSkill'
        ));
        //Chargement du formulaire Category
        $category = new Category();
        $formCategory = $this->createForm(new CategoryType(), $category, array(
            'action' => $this->generateUrl('filrouge_admin_add_category')  . '#adminCategory'
        ));
        return $this->render('AppBundle:Admin:administration.html.twig', array(
                'messageCsv' => $messageCsv,
                'categoryForm' => $formCategory->createView(),
                'skillForm' => $formSkill->createView()
        )); 
    }         
}
