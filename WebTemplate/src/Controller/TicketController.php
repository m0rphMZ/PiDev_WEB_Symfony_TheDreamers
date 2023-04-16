<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Event;
use App\Entity\User;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class TicketController extends AbstractController
{   
    //User ticket list:
    #[Route('/ticket', name: 'app_ticket_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {   
        $user = $entityManager->getRepository(User::class)->find(1);
        $tickets = $entityManager
            ->getRepository(Ticket::class)
            ->findBy(['user' => $user]);

        return $this->render('ticket/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    //Admin Ticket List:
    #[Route('/admin/ticketindex', name: 'app_ticket_index_admin', methods: ['GET'])]
    public function adminIndex(EntityManagerInterface $entityManager): Response
    {
        $tickets = $entityManager
            ->getRepository(Ticket::class)
            ->findAll();

        return $this->render('ticket/admin_index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    //Admin create Ticket:
    #[Route('/ticket/newTicket', name: 'app_ticket_new_admin', methods: ['GET', 'POST'])]
    public function new(Request $request, TicketRepository $ticketRepository, EventRepository $eventRepository): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket, [
            'event' => $this->getDoctrine()->getRepository(Event::class)->findAll(),
            'user' => $this->getDoctrine()->getRepository(User::class)->findAll(),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event = $ticket->getEvent();
            // Set Ticket Price
            $ticket->setPrice($event->getTicketprice());

            // Generate QR Code
            $ticket->setQrcodeimg("qrCodePlaceholderPath");

            // Save Ticket
            $ticketRepository->save($ticket, true);

            // Update Event ticket count
            $event = $ticket->getEvent();
            $event->setTicketcount($event->getTicketcount() - 1);
            $eventRepository->save($event, true);

            return $this->redirectToRoute('app_ticket_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    //Buy Ticket
    #[Route('/ticket/new/{id}', name: 'app_ticket_new', methods: ['GET', 'POST'])]
    public function buyTicket($id, EntityManagerInterface $entityManager): Response
    {
        $event = $entityManager->getRepository(Event::class)->find($id);
        $ticket = new Ticket();
        $ticket->setPrice($event->getTicketprice());
        $ticket->setEvent($event);
        $user = $entityManager->getRepository(User::class)->find(1);
        $ticket->setUser($user);
        $ticket->setQrcodeimg('your_qr_code_image_path');

        // decrease the remaining tickets count for the event
        $event->setTicketcount($event->getTicketcount() - 1);

        $entityManager->persist($ticket);
        $entityManager->persist($event);
        $entityManager->flush();

        return $this->redirectToRoute('app_event_show', ['eventId' => $id], Response::HTTP_SEE_OTHER);
    }

    #[Route('/ticket/{ticketId}', name: 'app_ticket_show', methods: ['GET'])]
    public function show(Ticket $ticket): Response
    {
        return $this->render('ticket/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }
	
	//ticket edit
    #[Route('/ticket/{ticketId}/edit', name: 'app_ticket_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ticket $ticket, TicketRepository $ticketRepository, EventRepository $eventRepository): Response
    {
        $oldTicket = $ticket->getEvent()->getEventId();
        $form = $this->createForm(TicketType::class, $ticket, [
            'event' => $this->getDoctrine()->getRepository(Event::class)->findAll(),
            'user' => $this->getDoctrine()->getRepository(User::class)->findAll(),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($oldTicket);
            var_dump($ticket->getEvent()->getEventId());
                
                //Increase old event ticket count
                $oldEvent = $eventRepository->find($oldTicket);
                $oldEvent->setTicketcount($oldEvent->getTicketcount() + 1);
                // $eventRepository->save($oldEvent, true);

                $newEvent = $eventRepository->find($form->get('event')->getData()->geteventId());
                $newEvent->setTicketcount($newEvent->getTicketcount() - 1);
                $eventRepository->save($newEvent, true);
                
                // Set Ticket Price
                $ticket->setPrice($newEvent->getTicketprice());

            // Save Ticket
            $ticketRepository->save($ticket, true);

            return $this->redirectToRoute('app_ticket_index_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }
	
	//Ticket delete
    #[Route('/ticket/{ticketId}', name: 'app_ticket_delete', methods: ['POST'])]
    public function delete(Request $request, Ticket $ticket, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getTicketId(), $request->request->get('_token'))) {
            $entityManager->remove($ticket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ticket_index_admin', [], Response::HTTP_SEE_OTHER);
    }
}
