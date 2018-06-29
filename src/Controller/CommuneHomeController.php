<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\ContactType;
use App\Form\ChoixCommuneType;
use App\Entity\Contact;
use App\Entity\Mairie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\MairieRepository;

class CommuneHomeController extends Controller
{
    /**
     * @Route("/declarer", name="declarer")
     */
    public function index(Request $request)
    {
        // $form = $this->createForm(ChoixCommuneType::class);
        // $form->handleRequest($request);

        $idCommune = 0;
        $SlugCommune = '';
        $nomCommune = '';
        
        // $form = $this->createForm(ChoixCommuneType::class);
        // $form->handleRequest($request);
        
        // if ($form->isSubmitted() && $form->isValid())
        // {
        //     // si on récupère bien une commune (astuce pour que le placeholder ne fasse pas planter)
        //     if ($form->get('commune')->getData())
        //     {
        //         $SlugCommune = $form->get('commune')->getData()->getMairieSlug();
        //         $idCommune = $form->get('commune')->getData()->getId();
        //         $nomCommune = $form->get('commune')->getData()->getMairieNomTouristique();
        //     }
        // }
        
        return $this->render('declarer/index.html.twig', [
            'controller_name' => 'CommuneHomeController',
            // 'form' => $form->createView(),
            'idCommune' => $idCommune,
            'nomCommune' => $nomCommune,
            'slugCommune' => $SlugCommune
        ]);
    }
    
    // PAGE COMMUNE DYNAMIQUE
    /**
     * @Route("/commune/{slug}", name="commune_show")
     */
    public function showOne($slug, Request $request, \Swift_Mailer $mailer)
    {
        $repoCommune = $this->getDoctrine()->getRepository(Mairie::class);
        $commune = $repoCommune->findOneBy(['mairie_slug' => $slug]);
        
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        dump($commune);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            $contactFormData = $form->getData();
            dump($contactFormData);
            
            $message = (new \Swift_Message('Vous avez une demande de renseignements'))
                ->setFrom($contactFormData->getEmail())
                ->setTo($contactFormData->getUserEmail())
                ->setSubject($contactFormData->getSubject())
                ->setBody($contactFormData->getMessage())
            ;
                
            $mailer->send($message);
            
            $this->addFlash(
                        'success', 
                        "Votre message a bien été envoyé."
                        );

            return $this->redirectToRoute('commune_show', ['_fragment' => 'section-contact']);
        }

        return $this->render('commune-show.html.twig', [
            'controller_name' => 'CommuneHomeController',
            'form' => $form->createView(),
            'commune' => $commune,
        ]);
    }
    
    // // PAGE COMMUNE STATIQUE
    // /**
    //  * @Route("/commune", name="commune_home")
    //  */
    // public function showHome()
    // {
    //     return $this->render('commune.html.twig', [
    //         'controller_name' => 'CommuneHomeController',
    //     ]);
    // }
    
    
    /**
    * @Route("/admin/mairie/back", name="commune_edit", methods="GET|POST")
    */
    public function edit()
    {
        return $this->render('admin_home/edit-commune.html.twig', [
            'controller_name' => 'CommuneHomeController',
        ]);
    }
    
    /**
     * @Route("/commune/{slug}", name="commune_home", methods="GET|POST")
     */
    public function contact ($slug, Request $request, \Swift_Mailer $mailer): Response
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            $contactFormData = $form->getData();
            dump($contactFormData);
            
            $message = (new \Swift_Message('Vous avez une demande de renseignements'))
                ->setFrom($contactFormData->getEmail())
                ->setTo($contactFormData->getUserEmail())
                ->setSubject($contactFormData->getSubject())
                ->setBody($contactFormData->getMessage())
            ;
                
            $mailer->send($message);
            
            $this->addFlash(
                        'success', 
                        "Votre message a bien été envoyé."
                        );

            return $this->redirectToRoute('commune_show', ['_fragment' => 'section-contact']);
        }

        return $this->render('commune-show.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}