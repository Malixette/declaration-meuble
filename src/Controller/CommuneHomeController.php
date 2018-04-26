<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommuneHomeController extends Controller
{
    /**
     * @Route("/commune", name="commune_home")
     */
    public function index()
    {
        return $this->render('commune_home/index.html.twig', [
            'controller_name' => 'CommuneHomeController',
        ]);
    }
}
