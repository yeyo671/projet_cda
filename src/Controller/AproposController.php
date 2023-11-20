<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AproposController extends AbstractController
{
    #[Route('/a-propos', name: 'a_propos')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('apropos/index.html.twig', [
            'painter' => $userRepository->getPainter(),
        ]);
    }
}
