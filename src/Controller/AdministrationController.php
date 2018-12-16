<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{
    /**
     * @Route("/admin-auth", name="admin-auth")
     */
    public function index()
    {
        return $this->render('administration/auth.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }
    
    /**
     * @Route("/admin-home", name="admin-home")
     */
    public function home()
    {
        return $this->render('administration/home.html.twig', [
            'controller_name' => 'AdministrationController',
        ]);
    }
}
