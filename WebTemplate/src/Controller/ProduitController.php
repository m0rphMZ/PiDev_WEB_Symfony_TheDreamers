<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }
    

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            // Handle file upload
            $file = $produit->getImageFile();
            if ($file) {
               
                $newFileName =uniqid().'.'.$file->guessExtension();
               
                $file->move(
                    $this->getParameter('images_directory'),
                    $newFileName
                );

                $produit->setImage($newFileName);
            }
            
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }
    #[Route('/Pfront', name: 'app_produit_indexF', methods: ['GET'])]
    public function indexF(EntityManagerInterface $entityManager): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('produit/front.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
      
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            
            // Handle file upload
            $file = $produit->getImageFile();
            if ($file) {
               
                $newFileName =uniqid().'.'.$file->guessExtension();
               
                $file->move(
                    $this->getParameter('images_directory'),
                    $newFileName
                );

                $produit->setImage($newFileName);
            }
            
            
            $entityManager->flush();
            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }
    // #[Route('/{id}/edit', name: 'app_update1')]
    // public function update(Request $resquest,$id){

        
    //     $produit = $this->getDoctrine()->getRepository(produit::class)->find($id);
    //     $Form = $this->createForm(Classe::class,$produit);
    //     $Form->handleRequest($resquest);
    //     if ($Form->isSubmitted() && $Form->isValid()){
    //         $em = $this->getDoctrine()->getManager();
    //         // $file = $produit->getImageFile();
    //         //         if ($file) {
                       
    //         //             $newFileName =uniqid().'.'.$file->guessExtension();
                       
    //         //             $file->move(
    //         //                 $this->getParameter('images_directory'),
    //         //                 $newFileName
    //         //             );
        
    //         //             $produit->setImage($newFileName);
    //         //         }
                    
    //         $em ->persist($produit);
    //         $em->flush();
    //          $this->addFlash('notice','Updated successfully!');
    //          return $this->RedirectToRoute('app_produit_index');

    //     }
    
    //     return $this->render('produit/edit.html.twig',[
    //         'Form' => $Form->createView()
    //     ]);
    // } 

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
