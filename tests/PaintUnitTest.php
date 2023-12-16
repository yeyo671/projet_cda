<?php

namespace App\Tests;

use App\Entity\Paint;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class PaintUnitTest extends TestCase
{
    public function testIsTrue(){

        $paint = new Paint();
        $datetime = new DateTime();
        $category = new Category();
        $user = new User();

        $paint->setName('name');
        $paint->setHeight(20.20);
        $paint->setWidth(20.20);
        $paint->setOnSale(true);
        $paint->setPrice(20.20);
        $paint->setDateOfCompletion($datetime);
        $paint->setDate($datetime);
        $paint->setDescription('description');
        $paint->setPortfolio(true);
        $paint->setSlug('slug');
        $paint->setFile('file');
        $paint->setUser($user);

        $this->assertTrue($paint->getName()==='name');
        $this->assertTrue($paint->getHeight()==20.20);
        $this->assertTrue($paint->getWidth()==20.20);
        $this->assertTrue($paint->isOnSale()===true);
        $this->assertTrue($paint->getPrice()==20.20);
        $this->assertTrue($paint->getDateOfCompletion()===$datetime);
        $this->assertTrue($paint->getDate()===$datetime);
        $this->assertTrue($paint->getDescription()==='description');
        $this->assertTrue($paint->isPortfolio()===true);
        $this->assertTrue($paint->getSlug()==='slug');
        $this->assertTrue($paint->getFile()==='file');
        $this->assertTrue($paint->getUser() === $user);
    }
    public function testIsFalse(){

        $paint = new Paint();
        $datetime = new DateTime();
        $category = new Category();
        $user = new User();

        $paint->setName('name');
        $paint->setHeight(20.20);
        $paint->setWidth(20.20);
        $paint->setOnSale(true);
        $paint->setPrice(20.20);
        $paint->setDateOfCompletion($datetime);
        $paint->setDate($datetime);
        $paint->setDescription('description');
        $paint->setPortfolio(true);
        $paint->setSlug('slug');
        $paint->setFile('file');
        $paint->setUser($user);

        $this->assertFalse($paint->getName()==='false');
        $this->assertFalse($paint->getHeight()==22.20);
        $this->assertFalse($paint->getWidth()==22.20);
        $this->assertFalse($paint->isOnSale()===false);
        $this->assertFalse($paint->getPrice()===22.20);
        $this->assertFalse($paint->getDateOfCompletion()===new DateTime());
        $this->assertFalse($paint->getDate()===new DateTime());
        $this->assertFalse($paint->getDescription()==='false');
        $this->assertFalse($paint->isPortfolio()===false);
        $this->assertFalse($paint->getSlug()==='false');
        $this->assertFalse($paint->getFile()==='false');
        $this->assertNotContains(new Category(), $paint->getCategory());
        $this->assertFalse($paint->getUser()=== new User());
    }

    public function testIsEmpty(){
        $paint = new Paint();
        $this->assertEmpty($paint->getName());
        $this->assertEmpty($paint->getHeight());
        $this->assertEmpty($paint->getWidth());
        $this->assertEmpty($paint->isOnSale());
        $this->assertEmpty($paint->getPrice());
        $this->assertEmpty($paint->getDateOfCompletion());
        $this->assertEmpty($paint->getDate());
        $this->assertEmpty($paint->getDescription());
        $this->assertEmpty($paint->isPortfolio());
        $this->assertEmpty($paint->getSlug());
        $this->assertEmpty($paint->getFile());
        $this->assertEmpty($paint->getCategory());
        $this->assertEmpty($paint->getUser());
        $this->assertEmpty($paint->getId());
    }

    public function testAddGetRemoveComment()
    {
        $paint = new Paint();
        $comment = new Comment();

        $this->assertEmpty($paint->getComments());

        $paint->addComment($comment);
        $this->assertContains($comment, $paint->getComments());

        $paint->removeComment($comment);
        $this->assertEmpty($paint->getComments());
    }

    public function testAddGetRemoveCategory()
    {
        $paint = new Paint();
        $category = new Category();

        $this->assertEmpty($paint->getCategory());

        $paint->addCategory($category);
        $this->assertContains($category, $paint->getCategory());

        $paint->removeCategory($category);
        $this->assertEmpty($paint->getCategory());
    }
}
