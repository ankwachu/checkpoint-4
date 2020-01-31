<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Event;
use App\Repository\CampusRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/circus")
 */

class CampusCircusController extends AbstractController
{
    /**
     * @Route("/", name="circus_index")
     * @param CampusRepository $campusRepository
     * @return Response
     */
    public function index(CampusRepository $campusRepository): Response
    {
        return $this->render('campus_circus/index.html.twig', [
            'campuses' => $campusRepository->findBy([],
                ['name' => 'ASC'],
                10),
        ]);
    }

    /**
     * @Route("/{id}", name="circus_detail", methods={"GET"})
     */
    public function show(Campus $campus, EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findEventByCampus($campus);
        return $this->render('campus_circus/show.html.twig', [
            'campus' => $campus,
            'events' => $events,
        ]);
    }
}
