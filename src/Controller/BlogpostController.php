<?php

namespace App\Controller;

use App\Entity\Blogpost;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\BlogpostRepository;
use App\Repository\CommentRepository;
use App\Service\CommentService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogpostController extends AbstractController
{
    #[Route('/actualites', name: 'actualites')]
    public function actualites(
        BlogpostRepository $blogpostRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data = $blogpostRepository->findBy([],['id' => 'DESC']);
        $blogposts = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('blogpost/actualites.html.twig', [
            'blogposts' => $blogposts,
        ]);
    }

    #[Route('//actualites/{slug})', name: 'actualites_details')]
    public function detail(
        Blogpost $blogpost, 
        Request $request, 
        CommentService $commentService,
        CommentRepository $commentRepository
        ): Response
    {
        $comments = $commentRepository->findComment($blogpost);
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $commentService->persistComment($comment, $blogpost, null);
            return $this->redirectToRoute('actualites_details', ['slug' => $blogpost->getSlug()]);
        }
    
        return $this->render('blogpost/detail.html.twig', [
            'blogpost' => $blogpost,
            'form' => $form->createView(),
            'comments' => $comments,
        ]);
    }    
}
