<?php

namespace App\Tests;

use App\Entity\Blogpost;
use DateTime;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue(){
        
        $blogpost = new Blogpost();
        $datetime = new DateTime();

        $blogpost->setTitle('title');
        $blogpost->setDate($datetime);
        $blogpost->setContent('content');
        $blogpost->setSlug('slug');

        $this->assertTrue($blogpost->getTitle()==='title');
        $this->assertTrue($blogpost->getDate()===$datetime);
        $this->assertTrue($blogpost->getContent()==='content');
        $this->assertTrue($blogpost->getSlug()==='slug');
    }

    public function testIsFalse(){
        
        $blogpost = new Blogpost();
        $datetime = new DateTime();

        $blogpost->setTitle('title');
        $blogpost->setDate($datetime);
        $blogpost->setContent('content');
        $blogpost->setSlug('slug');

        $this->assertFalse($blogpost->getTitle()==='false');
        $this->assertFalse($blogpost->getDate()===new DateTime());
        $this->assertFalse($blogpost->getContent()==='false');
        $this->assertFalse($blogpost->getContent()==='false');
    }

    public function testIsEmpty(){
        $blogpost = new Blogpost();

        $this->assertEmpty($blogpost->getTitle());
        $this->assertEmpty($blogpost->getDate());
        $this->assertEmpty($blogpost->getContent());
        $this->assertEmpty($blogpost->getContent());
    }
}
