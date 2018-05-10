<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Hebergement;
use App\Repository\UserRepository;
use App\Repository\HebergementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Controller\SessionInterface;

class UserController extends Controller
{
    /**
     * @Route("/inscription", name="inscription", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
            
            $user->setUserRole(2);
            $user->setMairie(null);
            $user->setUserDateInscription(new \DateTime());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            $this->addFlash(
                        'success', 
                        "bravo, vous êtes bien inscrit"
                        );
                        
            return $this->redirectToRoute('connexion');
            
            // return $this->redirectToRoute('connexion');
        }

        return $this->render('user/inscription.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    
   /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        $user->getMairie();
        
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("admin/proprietaire/edit", name="declarant_edit", methods="GET|POST")
     */
    public function edit(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user_id = $user->getId();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);
    
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();
            
            dump($user);

            return $this->redirectToRoute('dashboard_declarant');
        }

        return $this->render('admin_home/declarant-edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'nombre' => $nombre
        ]);
    }
    /**
     * @Route("admin/mairie/edit", name="infos_mairie_edit", methods="GET|POST")
     */
    
    public function editInfosMairie(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $user_id = $user->getId();
        
        $repoHeb = $this->getDoctrine()->getRepository(Hebergement::class);
 
        $hebergements = $repoHeb->findBy(array("user" => $user->getId()));
        $nombre = count($hebergements);
    
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->getDoctrine()->getManager()->flush();
            
            dump($user);

            return $this->redirectToRoute('dashboard_mairie');
        }

        return $this->render('admin_home/declarant-edit-mairie.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'nombre' => $nombre
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
