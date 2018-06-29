<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Hebergement;
use App\Entity\User;
use App\Entity\Mairie;
use App\Entity\OfficeTourisme;
use App\Form\HebergementType;

use App\Repository\HebergementRepository;

class AdminHomeController extends Controller
{
    /**
     * @Route("/admin/proprietaire/", name="dashboard_declarant")
     */
    public function index(HebergementRepository $repoHeb)
    {
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository(User::class);
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);

        $url = $_SERVER['REQUEST_URI'];
        
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));

        $mairie = $user->getMairie();

        

        return $this->render('admin_home/dashboard-proprio.html.twig', [
            'hebergements'  => $hebergements,
            'mairie'        => $mairie,
            'user'          => $user,
            'nombre'        => $nombre,
            'url'           => $url,
        ]);
    }
    
    /**
     * @Route("/admin/mairie/", name="dashboard_mairie")
     */
    public function indexMairie()
    {
        $url = $_SERVER['REQUEST_URI'];

        $user = $this->getUser();
        
        $mairie = $user->getMairie();
        
        $repo = $this->getDoctrine()->getRepository(User::class);
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        $hebergements = $repoHeb->findBy(array("mairie" => $mairie->getId()));
        $nombre = count($hebergements);

        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'hebergements'  => $hebergements,
            'user'          => $user,
            'mairie'        => $mairie,
            'nombre'        => $nombre,
            'url'           => $url,
        ]);
    }
    
    /**
     * @Route("/admin/office-tourisme/", name="dashboard_ot")
     */
    public function indexOt()
    {
        $url = $_SERVER['REQUEST_URI'];

        $user = $this->getUser();
        
        $officeTourisme = 
        
        $mairie = $user->getMairie();
        
        $repo = $this->getDoctrine()->getRepository(User::class);
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        $hebergements = $repoHeb->findBy(array("mairie" => $mairie->getId()));
        $nombre = count($hebergements);

        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'hebergements'  => $hebergements,
            'user'          => $user,
            'mairie'        => $mairie,
            'nombre'        => $nombre,
            'url'           => $url,
        ]);
    }
    
}
