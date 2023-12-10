<?php 

namespace App\Service;

use App\Entity\Blogpost;
use App\Entity\Comment;
use App\Entity\Paint;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;


class CommentService {
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack) {
        $this->manager = $manager;
        $this->flash = $requestStack->getCurrentRequest()->getSession()->getFlashBag();
    }

    public function persistComment(
        Comment $comment, 
        Blogpost $blogpost = null, 
        Paint $paint = null
    ): void {
        $comment->setIsPublished(false)
                ->setBlogpost($blogpost)
                ->setPaint($paint)
                ->setDate(new DateTime('now'));

        $this->manager->persist($comment);
        $this->manager->flush();
        $this->flash->add('success', 'Votre commentaire est bien envoyé merci. Il sera publié après approbation');
    }
}
