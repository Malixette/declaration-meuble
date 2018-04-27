<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicListingController extends Controller
{
    /**
     * @Route("/commune/listing", name="commune_listing")
     */
    public function index()
    {
        return $this->render('public_listing/index.html.twig', [
            'controller_name' => 'PublicListingController',
        ]);
    }
}
