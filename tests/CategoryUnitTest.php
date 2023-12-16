<?php

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Paint;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $category = new Category();

        $category->setName('name');
        $category->setDescription('description');
        $category->setSlug('slug');

        $this->assertTrue($category->getName()==='name');
        $this->assertTrue($category->getDescription()==='description');
        $this->assertTrue($category->getSlug()==='slug');
    }

    public function testIsFalse()
    {
        $category = new Category();

        $category->setName('name');
        $category->setDescription('description');
        $category->setSlug('slug');

        $this->assertFalse($category->getName()==='false');
        $this->assertFalse($category->getDescription()==='false');
        $this->assertFalse($category->getSlug()==='false');
    }

    public function testIsEmpty()
    {
        $category = new Category();
        $this->assertEmpty($category->getName());
        $this->assertEmpty($category->getDescription());
        $this->assertEmpty($category->getSlug());
        $this->assertEmpty($category->getId());
    }

    public function testAddGetRemovePaint()
    {
        $category = new Category();
        $paint = new Paint();

        $this->assertEmpty($category->getPaints());

        $category->addPaint($paint);
        $this->assertContains($paint, $category->getPaints());

        $category->removePaint($paint);
        $this->assertEmpty($category->getPaints());
        
    }


}
