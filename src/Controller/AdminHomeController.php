<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminHomeController extends Controller
{
    /**
     * @Route("/proprietaire", name="dashboard_declarant")
     */
    public function index()
    {
        return $this->render('admin_home/index.html.twig', [
            'controller_name' => 'AdminHomeController',
        ]);
    }
}
