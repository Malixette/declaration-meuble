<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;

class SecurityController 
    extends Controller
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $userEmail = $request->get('email');
        dump($userEmail);
        
        if($userEmail) {
            $token = $request->get('token');
            
            $userRepo = $this->getDoctrine()->getRepository(User::class);
            $user = $userRepo->findOneBy(['user_email' => $userEmail]);
            dump($user);
            $userToken = $user->getToken();
            dump($userToken);
            
            if ($token == $userToken) {
                $user->setIsActivated(true);
                
                $this->getDoctrine()->getManager()->flush();
            
                $this->addFlash(
                        'success', 
                        "Votre inscription est validée. Connectez-vous!"
                        );
            }
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
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