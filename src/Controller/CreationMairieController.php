<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Mairie;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\CommuneType;
use App\Form\MairieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Controller\SessionInterface;

class CreationMairieController extends Controller
{
    /**
     * @Route("/creation/mairie", name="creation_mairie")
     */
    public function index()
    {
        return $this->render('creation_mairie/creation-mairie.html.twig', [
            'controller_name' => 'CreationMairieController',
        ]);
    }

    /**
     * @Route("/creation/mairie", name="creation_mairie", methods="GET|POST")
     */
    
  public function new(Request $request): Response
    {
        $mairie = new Mairie();
        $formMairie = $this->createForm(MairieType::class, $mairie);
        
        
        $formMairie->handleRequest($request);

        if($formMairie->isSubmitted() && $formMairie->isValid())
        {
            $mairie->setVille(null)
                    ->setMairieLatitude(22.11)
                    ->setMairieLongitude('43.3')
                    ->setMairieSlug('barcelonnette')
                    ->setMairieDateInscription(new \DateTime());
                    
            $em = $this->getDoctrine()->getManager();
            $em->persist($mairie);
            $em->flush();
            
            $user = new User();
            $formUser = $this->createForm(CommuneType::class, $user);
            $formUser->handleRequest($request);
            
            return $this->render('creation_mairie/creation-mairie.html.twig', [
            'mairie' => $mairie,
            'user' => $user,
            'formUser' => $formUser->createView(),
            ]);
            
            if($formUser->isSubmitted() && $formUser->isValid())
            {
                dump($user);
                $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
            
                $user->setUserRole(3);
                $user->setUserPrenom($mairie->getMairieContactPrenom());
                $user->setUserNom($mairie->getMairieContactNom());
                $user->setUserCommune($mairie->getMairieNomTouristique());
                $user->setUserPays('FR');
                $user->setUserCodePostal(4400);
                $user->setUserTelephone($mairie->getMairieTelephoneContact);
                $user->setUserEmail($mairie->getMairieEmailContact);
                $user->setMairie($mairie->getId());
                $user->setUserDateInscription($mairie->getMairieDateInscription());
                $user->setPassword($password);
            
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            }
        }
        
        return $this->render('creation_mairie/creation-mairie.html.twig', [
            'mairie' => $mairie,
            'formMairie' => $formMairie->createView(),
        ]);
    }
}
