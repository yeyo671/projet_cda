<?php 

namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    private $entityManagerInterface;
    private $encoder;

    // Static property for the command name
    protected static $defaultName = 'app:create-user';

    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        UserPasswordHasherInterface $encoder
    )
    {
        // Corrected property assignment
        $this->entityManagerInterface = $entityManagerInterface;
        $this->encoder = $encoder;

        // Always call the parent constructor in Symfony commands
        parent::__construct();
    }

    protected function configure(): void
    {
        // Configuration of input arguments
        $this->addArgument('username', InputArgument::REQUIRED, 'the username of the user.')
             ->addArgument('password', InputArgument::REQUIRED, 'the password of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Create a new user instance
        $user = new User();

        // Set user properties based on input arguments
        $user->setEmail($input->getArgument('username'));
        $password = $this->encoder->hashPassword($user, $input->getArgument('password'));
        $user->setPassword($password)
             ->setRoles(['ROLE_PEINTRE']) // Assuming 'ROLE_PEINTRE' is a valid role
             ->setFirstname('')
             ->setName('')
             ->setPhoneNumber('');

        // For debugging purposes
        dump($user);

        // Persist the user entity
        $this->entityManagerInterface->persist($user);
        $this->entityManagerInterface->flush();

        // Return success code
        return Command::SUCCESS;
    }
}
