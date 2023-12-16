<?php 

namespace App\Service;

use App\Entity\Contact;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ContactService {
    private $manager;
    private $requestStack;

    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack) {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    public function persistContact(Contact $contact): void {
        $contact->setIsSend(false);
        $contact->setCreatedAt(new DateTime('now'));

        $this->manager->persist($contact);
        $this->manager->flush();

        if ($this->requestStack->getCurrentRequest()) {
            $session = $this->requestStack->getSession();
            $session->getFlashBag()->add('success', 'Votre message est bien envoyé, merci');
        }
    }

    public function isSend(Contact $contact): void {
        $contact->setIsSend(true);
        $this->manager->persist($contact);
        $this->manager->flush();
    }
}
