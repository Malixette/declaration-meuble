<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\LoginType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @Route("/")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/inscription", name="new_user")
     * @Route("/admin/propietaire/edit", name="edit_user")
     */
    public function new(Request $request, ObjectManager $manager, $id = null): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $user->setUserTelephone(0);
            $user->setMairieId(0);
            $user->setUserDateInscription(new \DateTime());
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            
            $manager->persist($user);
            $manager->flush();
            
            return $this->redirectToRoute('connexion');
        }

        return $this->render('user/new-user.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(Request $request, UserRepository $repo, SessionInterface $session): Response
    {
        $form = $this->createForm(LoginType::class);
        
        $form->handleRequest($request);
        
         if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            dump($data);
            
            $email = $data['email'];
            $password = $data['password'];
            
            $user = $repo->findOneByEmail($email);
            
            if($user)
            {
                    $session->set('connected', true);
                    $session->set('user', $user);
                    
                    $this->addFlash(
                        'success', "bravo, vous êtes bien connecté"
                        );
                    
                    return $this->redirectToRoute('dashboard_declarant');
            }
            else
            {
              $this->addFlash(
                        'danger', 
                        'Nous n\'avons pas trouvé de compte utilisateur avec cet email.'
                    );
            }
            
        }
        
        return $this->render('user/connexion.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods="GET")
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
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
