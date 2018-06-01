<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Hebergement;
use App\Entity\Mairie;
use App\Entity\User;

class InfosComplementairesController extends Controller
{
    /**
     * @Route("/infos/complementaires", name="infos_complementaires")
     */
    public function index()
    {
        $url = $_SERVER['REQUEST_URI'];
        
        $user    = $this->getUser();
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergement = $repoHeb->findBy(array("user" => $user->getId()));
        
        $user_id = $hebergement->getUser();
        
        $repoDeclarant = $this->getDoctrine()->getRepository(User::class);
        $userDeclarant = $repoDeclarant->findOneBy(['id' => $user_id]);

        
        return $this->render('infos_complementaires/index.html.twig', [
            'controller_name'   => 'InfosComplementairesController',
            'hebergement'   => $hebergement,
            'nombre'        => $nombre,
            'user'          => $user,
            'mairie'        => $mairie,
            'url'           => $url,
            'userDeclarant' => $userDeclarant,
        ]);
    }
}
