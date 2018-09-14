<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Mairie;
use App\Entity\Villes;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\CreationMairieType;
use App\Form\MairieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Controller\SessionInterface;
use App\Repository\MairieRepository;
use Symfony\Component\Filesystem\Filesystem;

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
        $fileSystem = new Filesystem();
        $formMairie = $this->createForm(MairieType::class, $mairie);
        $idMairie = 0;
        $nomMairie = $mairie->getMairieNomTouristique();
        $slugMairie = $mairie->getMairieSlug();
        $formMairie->handleRequest($request);
        
        $user = new User();
        $formUser = $this->createForm(CreationMairieType::class, $user);
        $formUser->handleRequest($request);
        

        if($formMairie->isSubmitted() && $formMairie->isValid())
        {
            $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
            $repoVilles = $this->getDoctrine()->getRepository(Villes::class);
            
            $inseeInput = $mairie->getInsee();
            $ville = $repoVilles->findOneBy(array("ville_code_commune" => $inseeInput));
            $villeSlug = $ville->getVilleSlug();
            
            // gestion des uploads
            $tampon = $mairie->getMairieTampon();
            if($tampon != null) {
                $tamponFileName = $this->generateUniqueFileName().'.tampon-'. $nomMairie . $tampon->guessExtension();
            
                $tampon->move(
                    $this->getParameter('images_directory'),
                    $tamponFileName
                );
                
                $mairie->setMairieTampon($tamponFileName);    
            } 
            
            $signatureFileName = 'signature'.md5(rand());
            dump($signatureFileName);
            // end gestion des uploads

            $mairie->setVilles($ville)
                   ->setSignatureFileName($signatureFileName)
                   ->setMairieLongitude(43)
                   ->setMairieLong(43)
                   ->setMairieLatitude(22)
                   ->setMairieLat(22)
                   ->setMairieSlug($villeSlug)
                   ->setMairieDateInscription(new \DateTime());
            
            $ville->setMairie($mairie);
            $villeMairieId = $ville->getMairie();
            
            // créer un dossier par mairie pour les uploads de fichiers
            // $fileSystem->mkdir("../src/assets/uploads/mairie/".$villeSlug);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($mairie);
            $em->persist($ville);
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
            
            // CONTACT MAIRIE = USER_NOM
            // SI NULL : USER_NOM = MAIRE
            $mairieNomContact = $mairie->getMairieContactNom();
            
            if ($mairieNomContact == null)
            {
                $mairieNomContact = $mairie->getMairieMaireNom();
            }

            $user->setMairie($mairie);
            $user->setUserName(md5(uniqid(rand())));            
            $user->setUserRole(3);
            $user->setUserPrenom($mairie->getMairieContactPrenom());
            $user->setUserNom($mairieNomContact);
            $user->setUserCommune($mairie->getMairieNomTouristique());
            $user->setUserPays('FR');
            $user->setUserAdresse($mairie->getMairieAdresse());
            $user->setUserPostalCode($mairie->getMairiePostalCode());
            $user->setUserCommune($mairie->getMairieCommune());
            $user->setUserTelephone($mairie->getMairieTelephoneGeneral());
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
    
    // Envoi des requêtes ajax pour vérifier le code INSEE mairie unique
    /**
     * @Route("/checkinsee", name="checkInsee")
     */
    public function checkInsee(){
        
        // if(isset($_POST['codeInsee'])) {
    
        //     $codeInsee = $_POST['codeInsee'];
        //     dump($codeInsee);
            
        //     $host = 'localhost';
        //     $user = 'root';
        //     $pass = ' ';
            
        //     mysql_connect($host, $user, $pass);
            
        //     mysql_select_db('declaration-meuble');
            
        //     $selectdata = " SELECT * FROM villes WHERE name LIKE '$codeInsee' ";
            
        //     $query = mysql_query($selectdata);
            
        //     while($row = mysql_fetch_array($query))
        //     {
        //      echo $codeInsee;
        //     }
        
        // }
        
        // $data = $request->getContent();
    }
    
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
