<?php

namespace App\Tests;

use App\Entity\Blogpost;
use App\Entity\Paint;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testIsTrue(){
        $user = new User();

        $user->setEmail('true@test.com');
        $user->setFirstName('firstName'); 
        $user->setName('name'); 
        $user->setPassword('password'); 
        $user->setAbout('about'); 
        $user->setInstagram('instagram'); 

        $this->assertTrue($user->getEmail()==='true@test.com');
        $this->assertTrue($user->getFirstname()==='firstName');
        $this->assertTrue($user->getName()==='name');
        $this->assertTrue($user->getPassword()==='password');
        $this->assertTrue($user->getAbout()==='about');
        $this->assertTrue($user->getInstagram()==='instagram');
    }

    public function testIsFalse(){

        $user = new User();

        $user->setEmail('true@test.com');
        $user->setFirstName('firstName'); 
        $user->setName('name'); 
        $user->setPassword('password'); 
        $user->setAbout('about'); 
        $user->setInstagram('instagram'); 

        $this->assertFalse($user->getEmail()==='false');
        $this->assertFalse($user->getFirstname()==='false');
        $this->assertFalse($user->getName()==='false');
        $this->assertFalse($user->getPassword()==='false');
        $this->assertFalse($user->getAbout()==='false');
        $this->assertFalse($user->getInstagram()==='false');
    }

    public function testIsEmpty(){
        $user = new User();
        $this->assertEmpty($user->getEmail());
        $this->assertEmpty($user->getFirstname());
        $this->assertEmpty($user->getName());
        $this->assertEmpty($user->getAbout());
        $this->assertEmpty($user->getInstagram());
        $this->assertEmpty($user->getId());

    }

    public function testAddGetRemovePaint()
    {
        $user = new User();
        $paint = new Paint();

        $this->assertEmpty($user->getPaints());

        $user->addPaint($paint);
        $this->assertContains($paint, $user->getPaints());

        $user->removePaint($paint);
        $this->assertEmpty($user->getPaints());
    }

    public function testAddGetRemoveBlogpost()
    {
        $user = new User();
        $blogpost = new Blogpost();

        $this->assertEmpty($user->getBlogposts());

        $user->addBlogpost($blogpost);
        $this->assertContains($blogpost, $user->getBlogposts());

        $user->removeBlogpost($blogpost);
        $this->assertEmpty($user->getBlogposts());
    }

}
