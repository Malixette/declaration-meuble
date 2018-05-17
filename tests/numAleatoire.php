    public function getNumeroDeclaration(): ?string
    {
      $date = new \DateTime;
      $dateFormat = $date->format('Ym');
      $insee = "CodeInsee";
      $id = $this->getId();
      $numCerfa= $insee . "/" . $dateFormat . "/" . $id;
      return $this->getNumeroDeclaration;
    }
    public function setNumeroDeclaration(string $numeroDeclaration): self
    {
      $this->getNumeroDeclaration= $numeroDeclaration;
      return $this;
    }
    
    
    
    
    
    
    commune home controller_name
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
    public function contact (Request $request, \Swift_Mailer $mailer): Response
    {
        // $contact = new Contact;
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            // $contactFormData = $form->getData();
            // dump($contactFormData);
            
            // $message = (new \Swift_Message('Vous avez une demande de renseignements'))
            //     ->setFrom($contactFormData->getEmail())
            //     ->setTo($contactFormData->getEmail())
            //     ->setBody($contactFormData->getMessage())
            // ;
                
            // $mailer->send($message);
            
            $this->addFlash(
                        'success', 
                        "Votre message a bien été envoyé."
                        );

            return $this->redirectToRoute('commune_home', ['_fragment' => 'section-contact']);
        }

        return $this->render('commune.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

    
    
    
    
    
    
    
    
    
    