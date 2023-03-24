<?php

namespace App\Controller;

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
}
