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
        
        return $this->render('admin_home/index.html.twig', [
            'hebergements' => $hebergements
        ]);
    }
}
