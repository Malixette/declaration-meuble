<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Mairie;
use App\Entity\Villes;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\UserType;
use App\Form\MairieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Controller\SessionInterface;
use App\Repository\MairieRepository;

class CreationMairieController extends Controller
{
    /**
     * @Route("/creation/mairie", name="creation_mairie")
     */
    public function index()
    {
        return $this->render('creation_mairie/creation-mairie.html.twig', [
            'controller_name' => 'CreationMairieController',
        ]);
    }

    /**
     * @Route("/creation/mairie", name="creation_mairie", methods="GET|POST")
     */
    
  public function new(Request $request, MairieRepository $mairieRepository): Response
    {
        $mairie = new Mairie();
        $formMairie = $this->createForm(MairieType::class, $mairie);
        $idMairie = 0;
        $nomMairie = $mairie->getMairieNomTouristique();
        $slugMairie = $mairie->getMairieSlug();
        $formMairie->handleRequest($request);
        
        $user = new User();
        $formUser = $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);
        
        $tampon = $mairie->getMairieTampon();
            
            // // // si on upload, on set avec nouvelle photo
            // // if($tampon != null) {
            // //     $tamponFileName = $this->generateUniqueFileName().'.tampon-'. $nomMairie . $tampon->guessExtension();
            
            // //     $tampon->move(
            // //         $this->getParameter('images_directory'),
            // //         $tamponFileName
            // //     );
                
            // //     $mairie->setMairieTampon($tamponFileName);    
            // } 

        if($formMairie->isSubmitted() && $formMairie->isValid())
        {
            $inseeInput = $mairie->getInsee();
            $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);

            $repoVilles = $this->getDoctrine()->getRepository(Villes::class);
            $ville = $repoVilles->findOneBy(array("ville_code_commune" => $inseeInput));
            
            $mairies = $repoMairie->findAll();

            $InseeExist = $repoMairie->findOneBy(array("insee" => $inseeInput));
            dump($InseeExist);
            $villeSlug = $ville->getVilleSlug();
            dump($ville);
            
            $mairie->setVilles($ville)
                   ->setMairieLongitude(43)
                   ->setMairieLatitude(22)
                   ->setMairieSlug($villeSlug)
                   ->setMairieDateInscription(new \DateTime());
                    
            $mairieVille = $mairie->getVilles();
            dump($mairieVille);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($mairie);
            $em->flush();
            $idMairie = $mairie->getId();
        }
        
        if($formUser->isSubmitted() && $formUser->isValid())
        {
            $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
            
            $idMairie = $request->get('idMairie');
            dump($idMairie);
            
            $mairieRepository = $this->getDoctrine()->getRepository(Mairie::class);
            $mairie = $mairieRepository->find($idMairie);
            $username = $user->getUsername();
            
            $user->setMairie($mairie);
            $user->setUserRole(3);
            // $user->setUserNom($mairie->getMairieContactNom());
            $user->setUserPrenom($mairie->getMairieContactPrenom());
            $user->setUserCommune($mairie->getMairieNomTouristique());
            $user->setUserPays('FR');
            $user->setUserAdresse($mairie->getMairieAdresse());
            $user->setUserPostalCode($mairie->getMairiePostalCode());
            $user->setUserCommune($mairie->getMairieCommune());
            $user->setUserTelephone($mairie->getMairieTelephoneGeneral());
            $user->setUserEmail($username);
            $user->setMairie($mairie);
            $user->setToken('coucou');
            $user->setIsActivated(true);
            $user->setUserDateInscription($mairie->getMairieDateInscription());
            $user->setPassword($password);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            $this->addFlash(
                        'success', 
                        "Votre inscription est enregistrée."
                        );
            
            return $this->redirectToRoute('connexion');
        }
        return $this->render('mairie/creation-mairie.html.twig', [
            'mairie'    => $mairie,
            'idMairie'  => $idMairie,
            'user'      => $user,
            'formMairie'=> $formMairie->createView(),
            'formUser'  => $formUser->createView()
        ]);
    }
    
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
