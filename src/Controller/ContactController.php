<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Service\ContactService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, ContactService $contactService): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        $projectRoot = realpath(__DIR__ . '/../../'); 

        //check si le formulaire est soumis et valide => check si token CSRF valdide
        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            $contactService->persistContact($contact);

            // Exécuter la commande après la validation du formulaire
            $process = new Process(['php', $projectRoot . '/bin/console', 'app:send-contact']);
            $process->run();

            // Vérifier s'il y a eu une erreur lors de l'exécution de la commande
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form-> createView(),
        ]);
    }
}
