<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'portfolio')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
