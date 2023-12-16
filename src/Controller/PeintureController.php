<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Paint;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\PaintRepository;
use App\Service\CommentService;
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
        $data = $paintRepository->findBy([],['date' => 'DESC']);
        $paints = $paginator->paginate(
            $data,
            $request->query->getInt('page',1)
            ,6
        );

        return $this->render('peinture/realisations.html.twig', [
            'paints' => $paints,
        ]);
    }

    #[Route('//realisations/{slug})', name: 'realisations_details')]
     public function details (
        Paint $paint,
        Request $request, 
        CommentService $commentService,
        CommentRepository $commentRepository
        ): Response {
            $comments = $commentRepository->findComment($paint);
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
            $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {
                $commentService->persistComment($comment, null, $paint);
                return $this->redirectToRoute('realisations_details', ['slug' => $paint->getSlug()]);
            }
            return $this->render('peinture/details.html.twig', [
                'paint'=>$paint,
                'form'=>$form->createView(),
                'comments'=>$comments
            ]);
        }
}
