<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Hebergement;
use App\Form\HebergementType;

class AdminHomeController extends Controller
{
    /**
     * @Route("/admin/proprietaire", name="dashboard_declarant")
     */
    public function index()
    {
        
        $repo = $this->getDoctrine()->getRepository(Hebergement::class);
        
        $hebergements = $repo->findAll();
        
        return $this->render('admin_home/dashboard-proprio.html.twig', [
            'hebergements' => $hebergements
        ]);
    }
    
    /**
     * @Route("/admin/mairie", name="dashboard_mairie")
     */
    public function indexMairie()
    {
        
        $repo = $this->getDoctrine()->getRepository(Hebergement::class);
        
        $hebergements = $repo->findAll();
        
        return $this->render('admin_home/dashboard-mairie.html.twig', [
            'hebergements' => $hebergements
        ]);
    }
    
    
}
