<?php

namespace App\Controller;

use App\Entity\Hebergement;
use App\Entity\Mairie;
use App\Entity\Villes;
use App\Entity\User;
use App\Form\HebergementType;
use App\Form\HebergementEditType;
use App\Form\HebergementVerifType;
use App\Form\HebergementValidationType;
use App\Repository\HebergementRepository;
use App\Repository\MairieRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;


/**
 * @Route("/admin/hebergement")
 */
class HebergementController extends Controller
{
    /**
     * @Route("/", name="hebergement_index", methods="GET")
     */
    public function index(HebergementRepository $hebergementRepository, MairieRepository $repoMairie): Response
    {
        return $this->render('hebergement/index.html.twig', ['hebergements' => $hebergementRepository->findAll()]);
    }

    /**
     * @Route("/new", name="hebergement_new", methods="GET|POST")
     */
    public function new(Request $request, HebergementRepository $hebergementRepository): Response
    {
        
        // Repositories
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        $repoVilles = $this->getDoctrine()->getRepository(Villes::class);
        
        // Valeurs par défaut pour l'affichage différent selon les étapes de déclaration 
        $idHebergement = 0;
        // $hebEtoiles = 0;
        $mairie = null;
        $url = $_SERVER['REQUEST_URI'];
        
        // récupérer l'objet user en cours
        $user = $this->getUser();
        $user_id = $user->getId();
        
        // Affichage carte de droite
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);
        
        // création d'un objet hébergement
        $hebergement = new Hebergement();
        $mairie = $hebergement->getMairie();
        
        // Formulaire de déclaration
        $form = $this->createForm(HebergementType::class, $hebergement, array('is_new' => true));
        $form->handleRequest($request);
        
    ////////////////////FICHIERS
        //$fileSystem = new Filesystem();
          //  try {
            //    $fileSystem->mkdir(sys_get_temp_dir().'/'.random_int(0, 1000));
            //} catch (IOExceptionInterface $exception) {
              //  echo "An error occurred while creating your directory at ".$exception->getPath();
            //}

        //$fileSystem->mkdir('/tmp/coucou', 0700);
    //////////////////////////////    
        
        
        // Formulaire de validation
        // $formVerif = $this->createForm(HebergementType::class, $hebergement);
        // $formVerif->handleRequest($request);
        
        // Formulaire d'édition

        if ($form->isSubmitted() && $form->isValid()) {
            
            dump($hebergement);
            // stockage de l'id hébergement par l'input hidden
            // $idHebergement = $request->get('idHebergement');
            // $idHebergement = $hebergement->getId();
            // $hebStatut = $hebergement->getHebStatut();

            $mairieNom = $hebergement->getHebCommune();
            $mairie = $repoMairie->findOneBy(['mairie_nom_touristique' => $mairieNom]);
            
            // $hebEtoiles = $hebergement->getHebEtoiles();
            // dump($hebEtoiles);
            
            // setter les infos qui ne sont pas gérées par User
            $hebergement->setUser($user);
            $hebergement->setHebDateCreation(new \DateTime());
            $hebergement->setHebDateDeclaration(new \DateTime());
            $hebergement->setHebCerfa(0);
            $hebergement->setHebStatut('en cours');
            $hebergement->setHebNumDeclaration(0);
            $hebergement->setMairie($mairie);
            // $hebergement->setHebEtoiles($hebEtoiles);
            
            //debug
            // $mairieHeb = $hebergement->getMairie();
            // dump($mairieHeb);
            // dump($hebergement);
            
            // ************** UPLOAD PHOTOS *************** //
            $file1 = $hebergement->getHebPhoto1();
            // si on upload, on set avec nouvelle photo
            if($file1 != null) {
                $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
            
                $file1->move(
                    $this->getParameter('images_directory'),
                    $fileName1
                );
                
                $hebergement->setHebPhoto1($fileName1);    
            } 
            // si pas d'upload, on met photo par defaut
            else
            {
                $hebergement->setHebPhoto1('defaut-image.png');   
            }
            // ************** UPLOAD PHOTOS *************** //
            
            
            // enregistrer hebergement en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($hebergement);
            $em->flush();
            
            $idHebergement = $hebergement->getId();
            
            return $this->redirectToRoute('hebergement_recap', ['id' => $idHebergement ]);
        }
        
        return $this->render('hebergement/new.html.twig', [
            'hebergement'   => $hebergement,
            'form'          => $form->createView(),
            'user'          => $user,
            'nombre'        => $nombre,
            'url'           => $url,
            'mairie'        => $mairie,
            'idHebergement' => $idHebergement,
            // 'hebEtoiles'    => $hebEtoiles,
        ]);
    }
    
    /**
     * @Route("/recap/{id}", name="hebergement_recap", methods="GET|POST")
     */
     public function recap (Request $request, Hebergement $hebergement) : Response
     {
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoVilles = $this->getDoctrine()->getRepository(Villes::class);
        $user = $this->getUser();
        
    ////Numéro de Cerfa
        dump($hebergement);
        // $idHebergement = $hebergement->getId();
        $mairie = $hebergement->getMairie();
        $idMairie = $mairie->getId();
        dump($idMairie);
        $insee = $repoVilles->findOneBy(['ville_code_commune' => $idMairie]);
        dump($insee);
        $date = new \DateTime;
        $dateFormat = $date->format('Ymd');
        $numCerfa= $insee . "-" . $dateFormat . "-" . $idHebergement;
        dump($numCerfa);
    ////    
        $form = $this->createForm(HebergementValidationType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $hebergement->setHebStatut('déclaré');
            $hebergement->setHebCerfa($numCerfa);
            $em = $this->getDoctrine()->getManager();
            $em->persist($hebergement);
            $em->flush();
            
            $this->addFlash(
                'success',
                'Un email de confirmation vous a été envoyé. La mairie traitera votre demande dans les meilleurs délais');
                
            return $this->redirectToRoute('dashboard_declarant');
        }

        return $this->render('hebergement/new_recap.html.twig', [
            'form'          => $form->createView(),
            'hebergement'   => $hebergement,
            'numCerfa'      => $numCerfa,
        ]);
     }

    /**
     * @Route("/modif/{id}", name="hebergement_modif", methods="GET|POST")
     */
    public function modif (Request $request, Hebergement $hebergement) : Response
    {
        $form = $this->createForm(HebergementType::class, $hebergement, array('is_new' => true));
        $form->handleRequest($request);
        
        $url = $_SERVER['REQUEST_URI'];
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hebergement);
            $em->flush();
            
            $idHebergement = $hebergement->getId();
            
            return $this->redirectToRoute('hebergement_recap', ['id' => $idHebergement ]);
        }
        return $this->render('hebergement/new_modif.html.twig', [
            'form'          => $form->createView(),
            'url'           => $url,
            // 'hebergement'    => $hebergement,
            // 'form'           => $form->createView(),
            // 'user'           => $user,
            // 'nombre'         => $nombre,
            // 'url'            => $url,
            // 'mairie'         => $mairie,
            // 'idHebergement'  => $idHebergement 
        ]);
    }

    /**
     * @Route("/show/{id}", name="hebergement_show", methods="GET")
     */
    public function show(Hebergement $hebergement): Response
    {
        // $latitude = $hebergement->getHebLat();
        // $longitude = $hebergement->getHebLong();
    
        $url = $_SERVER['REQUEST_URI'];   
        
        $user = $this->getUser();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
        $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
        $repoUser = $this->getDoctrine()->getRepository(User::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        
        $nombre = count($hebergements);
        
        dump($hebergement);
        $mairie = $hebergement->getMairie(); 
        dump($mairie);
        $mairieHeb = $repoUser->findOneBy(['mairie' => $mairie->getId()]);
        // dump($mairieHeb);
        
        return $this->render('hebergement/show.html.twig', [
            'hebergement'   => $hebergement,
            'nombre'        => $nombre,
            'user'          => $user,
            'url'           => $url,
            'mairie'        => $mairie,
            'mairieHeb'     => $mairieHeb,
            ]);
    }
    
     /**
     * @Route("/mairie/hebergement/{id}", name="mairie_hebergement_show", methods="GET")
     */
    public function showMairie(Hebergement $hebergement): Response
    {
        $latitude   = $hebergement->getHebLat();
        $longitude  = $hebergement->getHebLong();
        $mairie = $hebergement->getMairie();
        
        $url = $_SERVER['REQUEST_URI'];
        
        $user    = $this->getUser();
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);

        $user_id = $hebergement->getUser();

        $repoDeclarant = $this->getDoctrine()->getRepository(User::class);
        $userDeclarant = $repoDeclarant->findOneBy(['id' => $user_id]);

        return $this->render('hebergement/show-mairie.html.twig', [
            'hebergement'   => $hebergement,
            'nombre'        => $nombre,
            'user'          => $user,
            'mairie'        => $mairie,
            'url'           => $url,
            'userDeclarant' => $userDeclarant,
            ]);
    }
    

    /**
     * @Route("/show/edit/{id}", name="hebergement_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hebergement $hebergement): Response
    {
        $user    = $this->getUser();
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);
        $url = $_SERVER['REQUEST_URI'];  

        $form = $this->createForm(HebergementEditType::class, $hebergement,array('is_edit' => true));
        
        // memoriser valeur de la bdd dans variable pour comparer avec l'upload
        $photo1 = $hebergement->getHebPhoto1();
        $photo2 = $hebergement->getHebPhoto2();
        $photo3 = $hebergement->getHebPhoto3();
        
        $mairie = $hebergement->getMairie();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file1 = $hebergement->getHebPhoto1();
            $file2 = $hebergement->getHebPhoto2();
            $file3 = $hebergement->getHebPhoto3();
            
            // si on upload photo 1
            if($file1 != null) {
                $fileName1 = $this->generateUniqueFileName().'.'.$file1->guessExtension();
            
                $file1->move(
                    $this->getParameter('images_directory'),
                    $fileName1
                );
                
                $hebergement->setHebPhoto1($fileName1);    
            } 
            // si pas d'upload photo 1
            else
            {
                $hebergement->setHebPhoto1($photo1);   
            }
            
            // si on upload photo 2
            if($file2 != null) {
                $fileName2 = $this->generateUniqueFileName().'.'.$file2->guessExtension();
            
                $file2->move(
                    $this->getParameter('images_directory'),
                    $fileName2
                );
                
                $hebergement->setHebPhoto2($fileName2);    
            } 
            // si pas d'upload photo 2
            else
            {
                $hebergement->setHebPhoto2($photo2);   
            }
            
            // si on upload photo 3
            if($file3 != null) {
                $fileName3 = $this->generateUniqueFileName().'.'.$file3->guessExtension();
            
                $file3->move(
                    $this->getParameter('images_directory'),
                    $fileName3
                );
                
                $hebergement->setHebPhoto3($fileName3);    
            } 
            // si pas d'upload photo 2
            else
            {
                $hebergement->setHebPhoto3($photo3);   
            }


            $this->getDoctrine()->getManager()->flush();
            
            $this->addFlash(
                'success',
                'Vos modifications ont bien été sauvegardées.'
            );

            return $this->redirectToRoute('hebergement_edit', ['id' => $hebergement->getId()]);
           
        }
        
        $repoUser = $this->getDoctrine()->getRepository(User::class);
        $mairie = $hebergement->getMairie(); 
        // dump($mairie);
        $mairieHeb = $repoUser->findOneBy(['mairie' => $mairie->getId()]);
        
        return $this->render('hebergement/edit.html.twig', [
            'hebergement'   => $hebergement,
            'nombre'        => $nombre,
            'form'          => $form->createView(),
            'url'           => $url,
            'mairie'        => $mairie,
            'mairieHeb'     => $mairieHeb
        ]);
    }
    
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

    /**
     * @Route("/{id}", name="hebergement_delete", methods="DELETE")
     */
    public function delete(Request $request, Hebergement $hebergement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hebergement->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($hebergement);
            $em->flush();
        }
        
        $this->addFlash(
                'success',
                'Votre hébergement a bien été supprimé.'
        );

        return $this->redirectToRoute('dashboard_declarant');
    }
}
