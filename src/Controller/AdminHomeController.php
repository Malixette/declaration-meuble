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
        //$repoOt = $this->getDoctrine()->getRepository(OfficeTourisme::class);
        
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);

        // $hebergements = $repoHeb->findAll();
        // $repoOt = $repoOt->findAll();


        //$hebergements = $repoHeb->findByTest();
        //$hebergements = $repoHeb->findBySQL();
        //$repoOt = $repoOt->findAll();

        $mairie = $user->getMairie();
        //$ot = $mairie->getOfficeTourisme();

        
        return $this->render('admin_home/dashboard-proprio.html.twig', [
            'hebergements'  => $hebergements,
            'mairie'        => $mairie,
            'user'          => $user,
            'nombre'        => $nombre
            //'officeTourisme'=> $officeTourisme,
        ]);
    }
    
    /**
     * @Route("/admin/mairie/", name="dashboard_mairie")
     */
    public function indexMairie()
    {
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository(User::class);
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);

        $hebergements = $repoHeb->findAll();
        
        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'hebergements'  => $hebergements,
            'user'          => $user,
        ]);
    }
    
    
}
