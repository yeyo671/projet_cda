<?php

namespace App\Controller;

use App\Repository\PaintRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeintureController extends AbstractController
{
    #[Route('/realisations', name: 'realisations')]
    public function realisations(
        PaintRepository $paintRepository,
        PaginatorInterface $paginator,
        Request $request
        ): Response
    {
        $data = $paintRepository->findAll();
        $paints = $paginator->paginate(
            $data,
            $request->query->getInt('page',1)
            ,6
        );

        return $this->render('peinture/realisations.html.twig', [
            'paints' => $paints,
        ]);
    }
}