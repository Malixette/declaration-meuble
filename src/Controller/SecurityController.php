<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Repository\UserRepository;

class SecurityController 
    extends Controller
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // Token d'activation
        $userEmail = $request->get('email');
        if($userEmail) {
            $token = $request->get('token');
            
            $userRepo = $this->getDoctrine()->getRepository(User::class);
            $user = $userRepo->findOneBy(['user_email' => $userEmail]);
            dump($user);
            $userToken = $user->getToken();
            dump($userToken);
            
            if ($token == $userToken) {
                $user->setIsActivated(true);
                $user->setUserRole(2);
                
                $this->getDoctrine()->getManager()->flush();
            
                $this->addFlash(
                        'success', 
                        "Votre inscription est validée. Connectez-vous!"
                        );
            }
        }
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
    
        if ($error) {
            
            $lastUsername = $authenticationUtils->getLastUsername();
            $userRepo = $this->getDoctrine()->getRepository(User::class);
            $user = $userRepo->findOneBy(['user_email' => $lastUsername]);
            
            if ($user) {
                $this->addFlash(
                        'danger', 
                        "Mot de passe erronné."
                        );
            } else {
                $this->addFlash(
                        'danger', 
                        "Cette adresse email n'est pas enregistrée."
                        );
            }
        }
        // // $this->addFlash(
        //                 'danger', 
        //                 "Votre compte n'est pas activé. Un email vous a été envoyé avec les instructions pour valider votre compte."
        //                 );

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        dump($lastUsername);
        $user = $this->getUser();
        
        return $this->render('security/connexion.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request)
    {
        return new Response('<html><body>logout</body></html>');
    }

}