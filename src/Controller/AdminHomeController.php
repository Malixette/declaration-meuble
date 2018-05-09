<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Hebergement;
use App\Entity\User;
use App\Entity\Mairie;
use App\Entity\OfficeTourisme;
use App\Form\HebergementType;

class AdminHomeController extends Controller
{
    /**
     * @Route("/admin/proprietaire/", name="dashboard_declarant")
     */
    public function index()
    {
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository(User::class);
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoOt = $this->getDoctrine()->getRepository(OfficeTourisme::class);
        
        $hebergements = $repoHeb->findAll();
        
        $mairie = $user->getMairie();
        //$ot = $mairie->getOfficeTourisme();
        
        return $this->render('admin_home/dashboard-proprio.html.twig', [
            'hebergements'  => $hebergements,
            'mairie'        => $mairie,
            'user'          => $user,
            //'officeTourisme'=> $officeTourisme,
        ]);
    }
    
    /**
     * @Route("/admin/mairie/", name="dashboard_mairie")
     */
    public function indexMairie($id)
    {
        
        $repo = $this->getDoctrine()->getRepository(User::class);
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);

        $hebergements = $repoHeb->findAll();
        
        $user = $repo->find($id);
        $mairie = $user->getMairie();
        dump($mairie);
        dump($user);
        
        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'hebergements'  => $hebergements,
            'mairie'        => $mairie,
            'user'          => $user,
        ]);
    }
    
    
}
