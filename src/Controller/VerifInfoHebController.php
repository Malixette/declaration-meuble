<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Hebergement;
use App\Entity\Mairie;
use App\Entity\User;

class VerifInfoHebController extends Controller
{
    /**
     * @Route("/verification/information", name="verif_info_heb")
     */
    public function index()
    {
        $hebergement = new Hebergement();
        
        $latitude = $hebergement->getHebLat();
        $longitude = $hebergement->getHebLong();
        
    
        $url = $_SERVER['REQUEST_URI'];   
        
        $user = $this->getUser();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        $repoUser = $this->getDoctrine()->getRepository(User::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        
        $nombre = count($hebergements);
        
        
        $mairie = $hebergement->getMairie(); 
        
        //$mairieHeb = $repoUser->findOneBy(['mairie' => $mairie->getId()]);

        
        return $this->render('verif_info_heb/index.html.twig', [
            'controller_name' => 'VerifInfoHebController',
            'hebergement'   => $hebergement,
            'nombre'        => $nombre,
            'user'          => $user,
            'url'           => $url,
            'mairie'        => $mairie,
            //'mairieHeb'     => $mairieHeb,
            ]);
    }
}
