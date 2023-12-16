<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\Comment;
use App\Entity\Paint;
use DateTime;
use PHPUnit\Framework\TestCase;

class CommentUnitTest extends TestCase
{
    public function testIsTrue(){

        $comment = new Comment();
        $datetime = new DateTime();
        $blogpost = new Blogpost();
        $paint = new Paint();

        $comment->setAutor('autor');
        $comment->setEmail('email');
        $comment->setDate($datetime);
        $comment->setContent('content');
        $comment->setBlogpost($blogpost);
        $comment->setPaint($paint);

        $this->assertTrue($comment->getAutor()==='autor');
        $this->assertTrue($comment->getEmail()==='email');
        $this->assertTrue($comment->getDate()===$datetime);
        $this->assertTrue($comment->getContent()==='content');
        $this->assertTrue($comment->getBlogpost()===$blogpost);
        $this->assertTrue($comment->getPaint()===$paint);

    }

    public function testIsFalse(){

        $comment = new Comment();
        $datetime = new DateTime();
        $blogpost = new Blogpost();
        $paint = new Paint();

        $comment->setAutor('autor');
        $comment->setEmail('email');
        $comment->setDate($datetime);
        $comment->setContent('content');
        $comment->setBlogpost($blogpost);
        $comment->setPaint($paint);

        $this->assertFalse($comment->getAutor()==='false');
        $this->assertFalse($comment->getEmail()==='false');
        $this->assertFalse($comment->getDate()===new DateTime());
        $this->assertFalse($comment->getContent()==='false');
        $this->assertFalse($comment->getBlogpost()=== new Blogpost());
        $this->assertFalse($comment->getPaint()===new Paint());
    }

    public function testIsEmpty(){

        $comment = new Comment();
        $datetime = new DateTime();
        $blogpost = new Blogpost();
        $paint = new Paint();

        $this->assertEmpty($comment->getAutor());
        $this->assertEmpty($comment->getEmail());
        $this->assertEmpty($comment->getDate());
        $this->assertEmpty($comment->getContent());
        $this->assertEmpty($comment->getBlogpost());
        $this->assertEmpty($comment->getPaint());
        $this->assertEmpty($comment->getId());

    }
}
