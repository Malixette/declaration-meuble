<?php

namespace App\Controller;

use App\Entity\Hebergement;
use App\Form\HebergementType;
use App\Repository\HebergementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/hebergement")
 */
class HebergementController extends Controller
{
    /**
     * @Route("/", name="hebergement_index", methods="GET")
     */
    public function index(HebergementRepository $hebergementRepository): Response
    {
        return $this->render('hebergement/index.html.twig', ['hebergements' => $hebergementRepository->findAll()]);
    }

    /**
     * @Route("/new", name="hebergement_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $hebergement = new Hebergement();
        $form = $this->createForm(HebergementType::class, $hebergement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hebergement);
            $em->flush();

            return $this->redirectToRoute('hebergement_index');
        }

        return $this->render('hebergement/new.html.twig', [
            'hebergement' => $hebergement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hebergement_show", methods="GET")
     */
    public function show(Hebergement $hebergement): Response
    {
        return $this->render('hebergement/show.html.twig', ['hebergement' => $hebergement]);
    }

    /**
     * @Route("/edit/{id}", name="hebergement_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hebergement $hebergement): Response
    {
        $form = $this->createForm(HebergementType::class, $hebergement,array('is_edit' => true));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hebergement_edit', ['id' => $hebergement->getId()]);
        }

        return $this->render('hebergement/edit.html.twig', [
            'hebergement' => $hebergement,
            'form' => $form->createView(),
        ]);
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

        return $this->redirectToRoute('hebergement_index');
    }
}
