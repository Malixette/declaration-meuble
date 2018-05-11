<?php

namespace App\Controller;

use App\Entity\Hebergement;
use App\Entity\Mairie;
use App\Entity\User;
use App\Form\HebergementType;
use App\Form\HebergementEditType;
use App\Repository\HebergementRepository;
use App\Repository\MairieRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(Request $request): Response
    {
        $hebergement = new Hebergement();
        $user = $this->getUser();
        $user_id = $user->getId();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);
        
        $form = $this->createForm(HebergementType::class, $hebergement, array('is_new' => true));
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            
            $mairieNom = $hebergement->getHebCommune();
            $repoMairie = $this->getDoctrine()->getRepository(Mairie::class);
            $mairie = $repoMairie->findOneBy(['mairie_nom_touristique' => $mairieNom]);
            
            $hebergement->setUser($user);
            $hebergement->setHebDateCreation(new \DateTime());
            $hebergement->setHebDateDeclaration(new \DateTime());
            $hebergement->setHebCerfa(123);
            $hebergement->setHebStatut('en cours');
            $hebergement->setHebNumDeclaration('Mairie321');
            $hebergement->setMairie($mairie);

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
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($hebergement);
            $em->flush();
            
            $this->addFlash(
                'success',
                'Votre déclaration a bien été envoyée. Vous recevrez un email de confirmation très prochainement.'
            );

            return $this->redirectToRoute('dashboard_declarant');
        }

        return $this->render('hebergement/new.html.twig', [
            'hebergement'   => $hebergement,
            'form'          => $form->createView(),
            'user'          => $user,
            'nombre'        => $nombre
        ]);
    }

    /**
     * @Route("/{id}", name="hebergement_show", methods="GET")
     */
    public function show(Hebergement $hebergement): Response
    {
        $latitude = $hebergement->getHebLat();
        $longitude = $hebergement->getHebLong();
        
        $user = $this->getUser();
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);


        return $this->render('hebergement/show.html.twig', [
            'hebergement'   => $hebergement,
            'nombre'        => $nombre,
            'user'          => $user,
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
        dump($userDeclarant);
        
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
     * @Route("/edit/{id}", name="hebergement_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hebergement $hebergement): Response
    {
        $user    = $this->getUser();
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);

        
        $form = $this->createForm(HebergementEditType::class, $hebergement,array('is_edit' => true));
        
        // memoriser valeur de la bdd dans variable pour comparer avec l'upload
        $photo1 = $hebergement->getHebPhoto1();
        $photo2 = $hebergement->getHebPhoto2();
        $photo3 = $hebergement->getHebPhoto3();
        
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

        return $this->render('hebergement/edit.html.twig', [
            'hebergement'   => $hebergement,
            'nombre'        => $nombre,
            'form'          => $form->createView(),
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
