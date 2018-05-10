<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MentionsLegalesController extends Controller
{
    /**
     * @Route("/mentions-legales", name="mentions_legales")
     */
    public function index()
    {
        return $this->render('mentions_legales/index.html.twig', [
            'controller_name' => 'MentionsLegalesController',
        ]);
    }
}
