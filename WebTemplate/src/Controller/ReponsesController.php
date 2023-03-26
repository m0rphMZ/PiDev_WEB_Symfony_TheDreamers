<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Repository\ReponsesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReponsesController extends AbstractController
{
    #[Route('/reponses', name: 'app_reponses')]
    public function index(): Response
    {
        return $this->render('reponses/index.html.twig', [
            'controller_name' => 'ReponsesController',
        ]);
    }

    #[Route('/reclamation/{id}/reponses', name: 'reclamation_reponses')]
    public function reclamationReponses(Reclamation $reclamation, ReponsesRepository $reponsesRepository): Response
    {
        $reponses = $reponsesRepository->findResponsesByReclamation($reclamation);
        
        return $this->render('reponses/reclamation_reponses.html.twig', [
            'reclamation' => $reclamation,
            'reponses' => $reponses,
        ]);
    }







}
