<?php

namespace App\Controller;

use App\Entity\OfficeTourisme;
use App\Form\OfficeTourismeType;
use App\Repository\OfficeTourismeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/office/tourisme")
 */
class OfficeTourismeController extends Controller
{
    /**
     * @Route("/", name="office_tourisme_index", methods="GET")
     */
    public function index(OfficeTourismeRepository $officeTourismeRepository): Response
    {
        return $this->render('office_tourisme/index.html.twig', ['office_tourismes' => $officeTourismeRepository->findAll()]);
    }

    /**
     * @Route("/new", name="office_tourisme_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $officeTourisme = new OfficeTourisme();
        $form = $this->createForm(OfficeTourismeType::class, $officeTourisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($officeTourisme);
            $em->flush();

            return $this->redirectToRoute('office_tourisme_index');
        }

        return $this->render('office_tourisme/new.html.twig', [
            'office_tourisme' => $officeTourisme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="office_tourisme_show", methods="GET")
     */
    public function show(OfficeTourisme $officeTourisme): Response
    {
        return $this->render('office_tourisme/show.html.twig', ['office_tourisme' => $officeTourisme]);
    }

    /**
     * @Route("/{id}/edit", name="office_tourisme_edit", methods="GET|POST")
     */
    public function edit(Request $request, OfficeTourisme $officeTourisme): Response
    {
        $form = $this->createForm(OfficeTourismeType::class, $officeTourisme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('office_tourisme_edit', ['id' => $officeTourisme->getId()]);
        }

        return $this->render('office_tourisme/edit.html.twig', [
            'office_tourisme' => $officeTourisme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="office_tourisme_delete", methods="DELETE")
     */
    public function delete(Request $request, OfficeTourisme $officeTourisme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$officeTourisme->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($officeTourisme);
            $em->flush();
        }

        return $this->redirectToRoute('office_tourisme_index');
    }
}
