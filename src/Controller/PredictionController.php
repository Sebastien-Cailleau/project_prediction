<?php

namespace App\Controller;

use App\Entity\Prediction;
use App\Service\ApiClient;
use App\Form\PredictionType;
use App\Repository\PredictionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/prediction")
 */
class PredictionController extends AbstractController
{
    /**
     * @Route("/{id}", name="prediction_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Prediction $prediction): Response
    {
        return $this->render('prediction/show.html.twig', [
            'prediction' => $prediction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prediction_edit", methods={"GET","POST"}, requirements={"id":"\d+"})
     */
    public function edit(Request $request, Prediction $prediction): Response
    {
        $form = $this->createForm(PredictionType::class, $prediction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prediction_show', ['id' => $prediction->getId()]);
        }

        return $this->render('prediction/edit.html.twig', [
            'prediction' => $prediction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="prediction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();

        $prediction = new Prediction();
        $form = $this->createForm(PredictionType::class, $prediction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $prediction->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prediction);
            $entityManager->flush();

            return $this->redirectToRoute('prediction_show', ['id' => $prediction->getId()]);
        }

        return $this->render('prediction/new.html.twig', [
            'prediction' => $prediction,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}", name="prediction_delete", methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function delete(Request $request, Prediction $prediction): Response
    {
        if ($this->isCsrfTokenValid('delete' . $prediction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prediction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
