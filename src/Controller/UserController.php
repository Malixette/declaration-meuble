<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Hebergement;
use App\Repository\UserRepository;
use App\Repository\HebergementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\UserType;
use App\Form\MairieType;
use App\Form\RetrievePasswordType;
use App\Form\NewPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Controller\SessionInterface;

class UserController extends Controller
{
    /**
     * @Route("/inscription", name="inscription", methods="GET|POST")
     */
    public function new(Request $request, \Swift_Mailer $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
            // $token = base64_encode(random_bytes(30));
            $token = md5(uniqid(rand()));
            $email = $user->getUserEmail();
            
            $user->setUserRole(2);
            $user->setMairie(null);
            $user->setUserDateInscription(new \DateTime());
            $user->setPassword($password);
            $user->setToken($token);
            $user->setIsActivated(false);

            $message = (new \Swift_Message('Votre inscription sur déclarersonmeublé.com'))
                ->setFrom('declaration.meubles@gmail.com')
                ->setTo($email)
                ->setSubject('Validation d\'inscription')
                ->setBody(
                    $this->renderView(
                        'emails/inscription-validation.html.twig',
                        array(
                            'token' => $token,
                            'email' => $email,
                        )
                    ),
                    'text/html'
                )
            ;
            
            $mailer->send($message);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            
            $this->addFlash(
                        'success', 
                        "Votre inscription est enregistrée."
                        );
                        
            dump($message);
            dump($user->getUserEmail());
                        
            // return $this->redirectToRoute('connexion');
        }

        return $this->render('user/inscription.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    
   /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        $user->getMairie();
        
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("admin/proprietaire/edit", name="declarant_edit", methods="GET|POST")
     */
    public function edit(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user_id = $user->getId();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);
    
        $form = $this->createForm(UserType::class, $user,array('is_edit' => true));
        $form->handleRequest($request);
        
        $url = $_SERVER['REQUEST_URI'];

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();
            
             $this->addFlash(
                        'success', 
                        "Les modifications de vos informations personnelles ont été appliquées."
                        );

            return $this->redirectToRoute('dashboard_declarant');
        }
        return $this->render('admin_home/declarant-edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'nombre' => $nombre,
            'url'       => $url,
        ]);
    }
    /**
     * @Route("admin/mairie/edit", name="infos_mairie_edit", methods="GET|POST")
     */
    
    public function editInfosMairie(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user_id = $user->getId();
        $mairie = $user->getMairie();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        
        // count hebergement
        $hebergements = $repoHeb->findBy(array("mairie" => $mairie->getId()));
        $nombre = count($hebergements);
    
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        $formMairie = $this->createForm(MairieType::class, $mairie);
        $form->handleRequest($request);
        
        $url = $_SERVER['REQUEST_URI'];
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dashboard_mairie');
        }

        return $this->render('admin_home/declarant-edit-mairie.html.twig', [
            'user'      => $user,
            'form'      => $form->createView(),
            'nombre'    => $nombre,
            'mairie'    => $mairie,
            'formMairie'=> $formMairie->createView(),
            'url'       => $url,
            'nombre'    => $nombre
        ]);
    }

    /**
     * @Route("/connexion/forgot", name="forgot_password", methods="GET|POST")
     */
    public function retrievePassword(Request $request, \Swift_Mailer $mailer) {
        $mailForm = $this->createForm(RetrievePasswordType::class);
        $mailForm->handleRequest($request);
        
        $tokenVerif = $request->get('token');
        $userVerif = $request->get('user');
        $emailVerif = $request->get('email');

        if($mailForm->isSubmitted() && $mailForm->isValid()){
            
            $data = $mailForm->getData();
            $email = $data['user_email'];
            
            $userRepo = $this->getDoctrine()->getRepository(User::class);
            $user = $userRepo->findOneBy(['user_email' => $email]);
            
            if ($user) {
                $token = md5(uniqid(rand()));
                $user->setToken($token);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                
                $message = (new \Swift_Message('Réinitialiser votre mot de passe'))
                    ->setFrom('declaration.meubles@gmail.com')
                    ->setTo($email)
                    ->setSubject('Réinitialiser le mot de passe')
                    ->setBody(
                        $this->renderView(
                            'emails/retrieve-password.html.twig',
                            array(
                                'token' => $token,
                                'email' => $email,
                            )
                        ),
                        'text/html'
                );
                
                $mailer->send($message);
                $this->addFlash(
                        'success', 
                        "Un email avec les instructions à suivre vous a été envoyé. Vérifiez vos spams!"
                        );
                
            } else {
                $this->addFlash(
                        'danger', 
                        "Cette adresse email n'est pas enregistrée."
                        );
            }
        }
        
        $email = $request->get('email');
        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepo->findOneBy(['user_email' => $email]);
            
        $newForm = $this->createForm(UserType::class, $user, array('is_forgot' => true));
        $newForm->handleRequest($request);
        
        if($newForm->isSubmitted() && $newForm->isValid())
        {
            // on récupère le token et l'email stocké en bdd
            $token = $user->getToken();
            $email = $user->getUserEmail();
            
            // on récupère les données en GET dans les champs input hidden
            $tokenVerif = $request->get('token');
            $emailVerif = $request->get('email');
            
            if ($token == $tokenVerif && $email = $emailVerif) {
                // on récupère les données du formulaire
                $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
                
                $user->setPassword($password);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                
                $this->addFlash(
                    'success', 
                    "Votre nouveau mot de passe est enregistré."
                    );
                return $this->redirectToRoute('connexion');
                
            } else {
                $this->addFlash(
                    'danger', 
                    "Une erreur est survenue. Veuillez réessayer"
                    );
            }
            
        }
        
        return $this->render('security/retrieve-password.html.twig', [
            'mailForm' => $mailForm->createView(),
            'newForm' => $newForm->createView(),
            'user' => $userVerif,
            'email' => $emailVerif,
            'token' => $tokenVerif
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
