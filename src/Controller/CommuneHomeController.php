<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\ContactType;
use App\Form\ChoixCommuneType;
use App\Entity\Contact;
use App\Entity\Mairie;
use App\Entity\Ville;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use App\Entity\Villes;
use App\Repository\UserRepository;
use App\Form\CreationMairieType;
use App\Form\MairieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Controller\SessionInterface;
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
        
        $form = $this->createForm(ChoixCommuneType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            // si on récupère bien une commune (astuce pour que le placeholder ne fasse pas planter)
            if ($form->get('commune')->getData())
            {
                $SlugCommune = $form->get('commune')->getData()->getMairieSlug();
                $idCommune = $form->get('commune')->getData()->getId();
                $nomCommune = $form->get('commune')->getData()->getMairieNomTouristique();
            }  
        }
        
        return $this->render('declarer/index.html.twig', [
            'controller_name' => 'CommuneHomeController',
            'form' => $form->createView(),
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
        $form = null;
        
        $repoCommune = $this->getDoctrine()->getRepository(Mairie::class);
        $repoVilles = $this->getDoctrine()->getRepository(Villes::class);
        $commune = $repoCommune->findOneBy(['mairie_slug' => $slug]);
        $ville = $repoVilles->findOneBy(['ville_slug' => $slug]);
        
        // si on s'amuse à mettre n'imp dans l'url
        if ($commune == null || $ville == null)
        {
            $this->addFlash(
                'danger',
                'cette commune n\'est pas enregistrée dans notre service'
                );
            $this->redirectToRoute('declarer');
        }
        
        
        // formulaire de contact
        $emailMairie = $commune->getMairieEmailContact();
        
        if ($emailMairie) {
            
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
                    ->setTo($emailMairie)
                    ->setSubject($contactFormData->getSubject())
                    ->setBody($contactFormData->getMessage())
                ;
                    
                $mailer->send($message);
                
                $this->addFlash(
                            'success', 
                            "Votre message a bien été envoyé."
                            );
    
                return $this->redirectToRoute('commune_show', ['_fragment' => 'section-contact', 'slug' => $slug ]);
            }
        }
        
        dump($ville);
        
        if ($form != null) {
            return $this->render('commune-show.html.twig', [
                'controller_name' => 'CommuneHomeController',
                'form' => $form->createView(),
                'commune' => $commune,
                'ville' => $ville
            ]);
        } else {
            return $this->render('commune-show.html.twig', [
                'controller_name' => 'CommuneHomeController',
                'commune' => $commune,
                'ville' => $ville
            ]);
        }
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