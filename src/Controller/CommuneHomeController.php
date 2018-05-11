<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\ContactType;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommuneHomeController extends Controller
{
    /**
     * @Route("/commune", name="commune_home")
     */
    public function index()
    {
        return $this->render('commune.html.twig', [
            'controller_name' => 'CommuneHomeController',
        ]);
    }
    
    /**
     * @Route("/commune", name="commune_home", methods="GET|POST")
     */
    public function contact (Request $request): Response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            $this->addFlash(
                        'success', 
                        "votre message a bien été envoyé."
                        );

            return $this->redirectToRoute('commune_home', ['_fragment' => 'section-contact']);
        }

        return $this->render('commune.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
