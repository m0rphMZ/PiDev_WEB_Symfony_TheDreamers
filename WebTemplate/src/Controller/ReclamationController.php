<?php

namespace App\Controller;

use App\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reclamations = $entityManager->getRepository(Reclamation::class)->findAllReclamations();

        return $this->render('reclamation/rec.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    #[Route('/reclamation/new', name: 'new_reclamation')]
    public function new(Request $request): Response
    {
        $reclamation = new Reclamation();
        $form = $this->createFormBuilder($reclamation)
            ->add('titre_rec')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation = $form->getData();
            $reclamation->setDate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation');
        }

        return $this->render('reclamation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
