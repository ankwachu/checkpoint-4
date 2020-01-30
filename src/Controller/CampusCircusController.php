<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Repository\CampusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/campus-circus")
 */

class CampusCircusController extends AbstractController
{
    /**
     * @Route("/", name="campus-circus_index")
     * @param CampusRepository $campusRepository
     * @return Response
     */
    public function index(CampusRepository $campusRepository): Response
    {
        return $this->render('campus_circus/index.html.twig', [
            'campuses' => $campusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="campus_detail", methods={"GET"})
     */
    public function show(Campus $campus): Response
    {
        return $this->render('campus_circus/show.html.twig', [
            'campus' => $campus,
        ]);
    }
}
