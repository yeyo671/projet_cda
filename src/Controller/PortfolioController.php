<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Repository\PaintRepository;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'portfolio')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'categories' => $categoryRepository->findCategoriesWithPortfolioPaints(),
        ]);
    }

    #[Route('/portfolio/{slug}', name: 'portfolio_categorie')]
    public function categorie(string $slug, CategoryRepository $categoryRepository, PaintRepository $peintureRepository): Response {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);
        if (!$category) {
            throw $this->createNotFoundException('La catégorie demandée n\'existe pas.');
        }
        $paints = $peintureRepository->findAllPortfolio($category);
        return $this->render('portfolio/categorie.html.twig', [
            'category' => $category,
            'paints' => $paints,
        ]);
    }

    

}
