<?php

namespace App\Tests;

use App\Entity\Contact;
use DateTime;
use PHPUnit\Framework\TestCase;

class ContactUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $contact = new Contact;
        $date = new DateTime();

        $contact
        ->setName('name')
        ->setEmail('test@test.com')
        ->setMessage('test')
        ->setCreatedAt($date)
        ->setIsSend(true);

        $this->assertTrue($contact->getName() === 'name');
        $this->assertTrue($contact->getEmail() === 'test@test.com');
        $this->assertTrue($contact->getMessage() === 'test');
        $this->assertTrue($contact->getCreatedAt() === $date);
        $this->assertTrue($contact->getIsSend() === true);
    }

    public function testIsFalse()
    {
        $contact = new Contact;
        $date = new DateTime();

        $contact
        ->setName('name')
        ->setEmail('test@test.com')
        ->setMessage('test')
        ->setCreatedAt($date)
        ->setIsSend(true);

        $this->assertFalse($contact->getName() === 'false');
        $this->assertFalse($contact->getEmail() === 'false');
        $this->assertFalse($contact->getMessage() === 'false');
        $this->assertFalse($contact->getCreatedAt() === new DateTime());
        $this->assertFalse($contact->getIsSend() === false);
    }

    public function testIsEmpty()
    {
        $contact = new Contact;

        $this->assertEmpty($contact->getName());
        $this->assertEmpty($contact->getEmail());
        $this->assertEmpty($contact->getMessage());
        $this->assertEmpty($contact->getCreatedAt());
        $this->assertEmpty($contact->getIsSend());
    }
}
