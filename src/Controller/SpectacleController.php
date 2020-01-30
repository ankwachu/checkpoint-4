<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\CampusSearchType;
use App\Repository\CampusRepository;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/spectacle")
 */
class SpectacleController extends AbstractController
{
    /**
     * @Route("/", name="spectacle_index")
     * @param EventRepository $eventRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EventRepository $eventRepository, CampusRepository $campusRepository, Request $request): Response
    {
        $events = $eventRepository->findAll();
        $form = $this->createForm(CampusSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $events = $eventRepository->searchByName($search);
        }

        return $this->render('spectacle/index.html.twig', [
            'events' => $events,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_detail", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('spectacle/show.html.twig', [
            'event' => $event,
        ]);
    }
}
