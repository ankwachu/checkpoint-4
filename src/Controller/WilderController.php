<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class WilderController extends AbstractController
{
    /**
     * @Route("/wilder", name="wilder")
     * @param UserRepository $userRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('wilder/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
}
