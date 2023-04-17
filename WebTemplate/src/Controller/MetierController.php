<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MetierController extends AbstractController
{
  

    #[Route('/metier', name: 'app_rech')]
    public function recherche(Request $request,UserRepository $repo,SessionInterface $session): Response
    {
        $searchQuery = $request->query->get('search');
    
        $users = $repo->findBySearchQuery($searchQuery);
        $session->set('usr_search', $users);
    
        return $this->render('user/index.html.twig', [
            'users' => $users,
            'searchQuery' => $searchQuery,
        ]);
    }


    #[Route('/filtre', name: 'app_rech_art')]
    public function index(Request $request, UserRepository $repo,SessionInterface $session) : Response
    {
        $role = $request->query->get('role');
        
        if ($session->has('usr_search') && !empty($session->get('usr_search'))) {
            $usr_search = $session->get('usr_search');
            $users = [];
        
            foreach ($usr_search as $user) {
                $usersWithRole = $repo->findByRole($role); 
                foreach ($usersWithRole as $userWithRole) {
                    if ($user->getIdUser() == $userWithRole->getIdUser()) {
                        $users[] = $userWithRole;
                        break;
                    }
                }
            }
        } else {
            $users = $repo->findByRole($role);
        }
        




        return $this->render('user/index.html.twig', [
            'users' => $users,
             'role' => $role,
            
        ]);
    }

}
