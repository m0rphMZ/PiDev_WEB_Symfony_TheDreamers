<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


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
            ->add('titre_rec', TextType::class, [
                'label' => 'Titre de réclamation',
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de reclamation',
                'choices' => [
                    'User' => 'User',
                    'Ticket' => 'Ticket',
                    'Evénement' => 'Evénement',
                    'Autre aide' => 'Autre aide',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Décrivez le problème que vous rencontrez',
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation = $form->getData();
            $reclamation->setDateCreation(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find(10);
            $reclamation->setUser($user);
            $entityManager->persist($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation');
        }

        return $this->render('reclamation/newRec.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
