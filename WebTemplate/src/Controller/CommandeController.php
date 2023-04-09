<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;

/**
 * @Route("/admin/commande")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/invoice/show/{id}", name="app_livraison_invoive", methods={"GET"})
     */
    public function invoice($id, CommandeRepository $commandeRepository): Response
    {
        $totale = 0;
        $commande = $commandeRepository->findOneByIdC($id);
        foreach ($commande->getOrderItem() as $item) {
            $totale = $totale + $item->getQuantity() * $item->getProduit()->getPrix();
        }
        $totale = $totale - ($totale * ($commande->getRemise() / 100));
        $pdfOptions = new \Dompdf\Options();
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);
        $html = $this->renderView('commande/invoice.html.twig', array('commande' => $commande,
            'totale' => $totale));

        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
        exit(0);
    }

    /**
     * @Route("/", name="app_admin_commande", methods={"GET"})
     */
    public function index(Request $request, CommandeRepository $commandeRepository, PaginatorInterface $paginator): Response
    {
 
          $results = $commandeRepository->findAll(); // Remplacez "searchByTitle" par la méthode que vous utilisez pour rechercher les cours
      $pagination = $paginator->paginate(
          $results, /* query NOT result */
          $request->query->getInt('page', 1), /*page number*/
          2 /*limit per page*/
      );
        return $this->render('commande/index.html.twig', [
            'commandes' => $pagination,
            'tri' => 'ASC'
        ]);
    }

    


    /**
     * @Route("/mes/Commandes", name="mesCommande", methods={"GET"})
     */
    public function mesCommande(Request $request, CommandeRepository $commandeRepository, \Knp\Component\Pager\PaginatorInterface $paginator): Response
    {
        $commande = $commandeRepository->findBy([
            "user" => 3,
            "statue" => "placed"
        ]);
        $pagination = $paginator->paginate(
            $commande, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );
        return $this->render('commande/mesCommande.html.twig', [
            'commandes' => $pagination,
        ]);
    }

   

    /**
     * @Route("/new", name="app_commande_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CommandeRepository $commandeRepository): Response
    {
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeRepository->add($commande, true);

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande/new.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idC}", name="app_commande_show", methods={"GET"})
     */
    public function show(Commande $commande): Response
    {
        return $this->render('commande/show.html.twig', [
            'commande' => $commande,
        ]);
    }

    /**
     * @Route("/{idC}/edit", name="app_commande_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Commande $commande, CommandeRepository $commandeRepository): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandeRepository->add($commande, true);

            return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{idC}", name="app_commande_delete", methods={"POST"})
     */
    public function delete(Request $request, Commande $commande, CommandeRepository $commandeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commande->getIdC(), $request->request->get('_token'))) {
            $commandeRepository->remove($commande, true);
        }

        return $this->redirectToRoute('app_commande_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/front/{idC}", name="app_commande_delete_front", methods={"POST"})
     */
    public function deletefront(Request $request, Commande $commande, CommandeRepository $commandeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $commande->getIdC(), $request->request->get('_token'))) {
            $commandeRepository->remove($commande, true);
        }

        return $this->redirectToRoute('mesCommande', [], Response::HTTP_SEE_OTHER);
    }


}
