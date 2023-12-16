<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\Comment;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue(){
        
        $blogpost = new Blogpost();
        $datetime = new DateTime();
        $user = new User();

        $blogpost->setTitle('title');
        $blogpost->setDate($datetime);
        $blogpost->setContent('content');
        $blogpost->setSlug('slug');
        $blogpost->setUser($user);

        $this->assertTrue($blogpost->getTitle()==='title');
        $this->assertTrue($blogpost->getDate()===$datetime);
        $this->assertTrue($blogpost->getContent()==='content');
        $this->assertTrue($blogpost->getSlug()==='slug');
        $this->assertTrue($blogpost->getUser()===$user);
    }

    public function testIsFalse(){
        
        $blogpost = new Blogpost();
        $datetime = new DateTime();
        $user = new User();


        $blogpost->setTitle('title');
        $blogpost->setDate($datetime);
        $blogpost->setContent('content');
        $blogpost->setSlug('slug');
        $blogpost->setUser($user);


        $this->assertFalse($blogpost->getTitle()==='false');
        $this->assertFalse($blogpost->getDate()===new DateTime());
        $this->assertFalse($blogpost->getContent()==='false');
        $this->assertFalse($blogpost->getContent()==='false');
        $this->assertFalse($blogpost->getUser()===new User());

    }

    public function testIsEmpty(){
        $blogpost = new Blogpost();

        $this->assertEmpty($blogpost->getTitle());
        $this->assertEmpty($blogpost->getDate());
        $this->assertEmpty($blogpost->getContent());
        $this->assertEmpty($blogpost->getContent());
        $this->assertEmpty($blogpost->getId());
    }

    public function testAddGetRemoveComment()
    {
        $blogpost = new Blogpost();
        $comment = new Comment();

        $this->assertEmpty($blogpost->getComments());

        $blogpost->addComment($comment);
        $this->assertContains($comment, $blogpost->getComments());

        $blogpost->removeComment($comment);
        $this->assertEmpty($blogpost->getComments());
    }
}
