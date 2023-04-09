<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Entity\Reponses;
use App\Entity\User;
use App\Repository\ReponsesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;



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
                'label' => 'Titre de réclamation :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le titre de la réclamation ne doit pas être vide',
                    ]),
                ],
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de reclamation :',
                'choices' => [
                    'Un problème avec votre expérience utilisateur' => 'User',
                    'Un problème avec votre/vos billet(s)' => 'Ticket',
                    'Un problème avec un événement' => 'Evénement',
                    'Un autre type daide' => 'Autre aide',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
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


    #[Route('/reclamation/{id}', name: 'show_reclamationById')]
    public function show(Request $request, int $id, ReponsesRepository $reponsesRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
    
        if (!$reclamation) {
            throw $this->createNotFoundException('Reclamation not found');
        }
    
        $reponses = $reponsesRepository->findResponsesByReclamation($reclamation);
    
        $reponse = new Reponses();
        $form = $this->createFormBuilder($reponse)
            ->add('rep_description', TextareaType::class, [
                'label' => 'Description :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez ajouter une description pour votre réponse',
                    ]),
                ],
            ])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $reponse = $form->getData();
            $reponse->setDateRep(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find(10);
            $reponse->setUser($user);
            $reponse->setRec($reclamation);
            $entityManager->persist($reponse);
            $entityManager->flush();
    
            return $this->redirectToRoute('show_reclamationById', ['id' => $reclamation->getRecId()]);
        }
    
        return $this->render('reclamation/showRec.html.twig', [
            'reclamation' => $reclamation,
            'reponses' => $reponses,
            'form' => $form->createView(),
        ]);
    }
    



    #[Route('/reclamation/{id}/delete', name: 'delete_reclamation')]

        public function deleteReclamation(Request $request, int $id): Response
        {
            $entityManager = $this->getDoctrine()->getManager();
            $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);

            if (!$reclamation) {
                throw $this->createNotFoundException(
                    'No reclamation found for id '.$id
                );
            }

            $entityManager->remove($reclamation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reclamation');
        }





       /* #[Route('/reclamation/{id}/new-response', name: 'new_reponse')]
            public function newResponse(Request $request, int $id): Response
            {
                $entityManager = $this->getDoctrine()->getManager();
                $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);

                if (!$reclamation) {
                    throw $this->createNotFoundException('Reclamation not found');
                }

                $reponse = new Reponses();
                $form = $this->createFormBuilder($reponse)
                    ->add('rep_description', TextareaType::class, [
                        'label' => 'Description :',
                    ])
                    ->getForm();

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $reponse = $form->getData();
                    $reponse->setDateCreation(new \DateTime());
                    $reponse->setReclamation($reclamation);
                    $entityManager->persist($reponse);
                    $entityManager->flush();

                    return $this->redirectToRoute('show_reclamationById', ['id' => $reclamation->getId()]);
                }

                return $this->render('reclamation/showRec.html.twig', [
                    'reclamation' => $reclamation,
                    'form' => $form->createView(),
                ]);
            }

            */



    #[Route('/admin/reclamations', name: 'app_reclamations_admin')]
    public function indexAdminRec(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reclamations = $entityManager->getRepository(Reclamation::class)->findAllReclamations();

        return $this->render('reclamation/adminAllRec.html.twig', [
            'reclamations' => $reclamations,
        ]);
    }

    #[Route('admin/reclamations/{id}', name: 'show_reclamationById_admin')]
    public function showRecAdmin(Request $request, int $id, ReponsesRepository $reponsesRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
    
        if (!$reclamation) {
            throw $this->createNotFoundException('Reclamation not found');
        }
    
        $reponses = $reponsesRepository->findResponsesByReclamation($reclamation);
    
        $reponse = new Reponses();
        $form = $this->createFormBuilder($reponse)
            ->add('rep_description', TextareaType::class, [
                'label' => 'Description :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez ajouter une description pour votre réponse',
                    ]),
                ],
            ])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $reponse = $form->getData();
            $reponse->setDateRep(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->find(10);
            $reponse->setUser($user);
            $reponse->setRec($reclamation);
            $reponse->setIsAdminReponse(true);
            $entityManager->persist($reponse);
            $entityManager->flush();
    
            return $this->redirectToRoute('show_reclamationById_admin', ['id' => $reclamation->getRecId()]);
        }
    
        return $this->render('reclamation/adminShowRec.html.twig', [
            'reclamation' => $reclamation,
            'reponses' => $reponses,
            'form' => $form->createView(),
        ]);
    }



    #[Route('admin/reclamations/{id}/close', name: 'close_reclamation')]

    public function closeReclamation(Reclamation $reclamation): Response
    {
        $reclamation->setStatus('Fermée');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        
        $this->addFlash('success', 'Reclamation '.$reclamation->getTitreRec().' a été fermée.');

        return $this->redirectToRoute('show_reclamationById_admin', ['id' => $reclamation->getRecId()]);
    }









            











}