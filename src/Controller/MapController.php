<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Hebergement;
use App\Entity\User;
use App\Entity\Mairie;
use App\Entity\OfficeTourisme;

class MapController extends Controller
{
    /**
     * @Route("/map", name="map")
     */
    public function index()
    {
        $user = $this->getUser();
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);

        $url = $_SERVER['REQUEST_URI'];
        
        $mairie = $user->getMairie();

        $hebergements = $repoHeb->findBy(array("mairie" => $mairie->getId()));
        $repoDeclarant = $this->getDoctrine()->getRepository(User::class);
        $userDeclarant = $repoDeclarant->findOneBy(['id' => $user_id]);

        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'controller_name'   => 'MapController',
            'hebergements'      => $hebergements,
            'user'              => $user,
            'mairie'            => $mairie,
            'nombre'            => $nombre,
            'url'               => $url,
            
        ]);
    }
    public function showMaps()
    {
        $user    = $this->getUser();
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        dump($hebergements);

        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'controller_name'   => 'MapController',
            'hebergements'      => $hebergements,
            'user'              => $user,
            'mairie'            => $mairie,
        ]);
    }
}
