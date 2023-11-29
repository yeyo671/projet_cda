<?php

namespace App\Command;

use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use App\Service\ContactService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class SendContactCommand extends Command {

    private $contactRepository;
    private $mailer;
    private $contactService;
    private $userRepository;
    protected static $defaultName = 'app:send-contact';

    public function __construct(
        ContactRepository $contactRepository,
        MailerInterface $mailer,
        ContactService $contactService,
        UserRepository $userRepository
    ){
        $this->contactRepository = $contactRepository;
        $this->mailer = $mailer;
        $this->contactService = $contactService;
        $this->userRepository = $userRepository;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output){
        $toSend = $this->contactRepository->findBy(['isSend' => false]);
        $painter = $this->userRepository->getPainter();
        $address = new Address($painter->getEmail(), $painter->getName() . ' ' . $painter->getFirstName());
    
        foreach ($toSend as $contact) {
            $email = (new Email())
                ->from($contact->getEmail())
                ->to($address)
                ->subject('Nouveau message de ' . $contact->getName())
                ->text($contact->getMessage());
    
            $this->mailer->send($email);
            $this->contactService->setContactAsSent($contact);

        }
    
        return Command::SUCCESS;
    }

}