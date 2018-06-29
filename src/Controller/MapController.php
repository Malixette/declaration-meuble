<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Hebergement;
use App\Entity\User;
use App\Entity\Mairie;
use App\Entity\OfficeTourisme;
use Symfony\Component\Serializer\SerializerInterface;


class MapController extends Controller
{
    /**
     * @Route("/map", name="map")
     */
    public function index()
    {
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $user = $this->getUser();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        
        $mairie = $user->getMairie();
        $mairieId = $mairie->getId();

        $hebergements = $repoHeb->findBy(array("mairie" => $mairieId));
        dump($hebergements);
        
        
        
        $nombre = count($hebergements);

        $url = $_SERVER['REQUEST_URI'];
        
        $mairie = $user->getMairie();

        $hebergements = $repoHeb->findBy(array("mairie" => $mairie->getId()));
        $repoDeclarant = $this->getDoctrine()->getRepository(User::class);
        // $userDeclarant = $repoDeclarant->findOneBy(['id' => $user_id]);

        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'controller_name'   => 'MapController',
            'hebergements'      => $hebergements,
            'user'              => $user,
            'mairie'            => $mairie,
            // 'nombre'            => $nombre,
            'url'               => $url,
            
        ]);
    }
    
    /**
     * @Route("/carte/hebergements", name="carte", methods="GET|POST")
     */
    public function showMapCommune(SerializerInterface $serializer)
    {
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $user    = $this->getUser();
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        
        $mairie = $user->getMairie();
        $mairieId = $mairie->getId();

        $hebergements = $repoHeb->findBy(array("mairie" => $mairieId));
        dump($hebergements);
        // $nombre = count($hebergements);
        
        // $serializer = new \Serializer;
        
        // foreach($hebergements as $h){
        //     $lat = $h->getHebLat();
        //     $lon = $h->getHebLong();
        // }
            
        // $jsonContent = $serializer->serialize($hebergements, 'json');
        // dump($jsoncontent);

        return $this->render('map/index.html.twig', [
            'controller_name'   => 'MapController',
            'hebergements'      => $hebergements,
            'user'              => $user,
            'mairie'            => $mairie,
        ]);
    }
}
