<?php
namespace UnaGauchada\UserBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CreateAdminCommand extends ContainerAwareCommand {

    protected function configure(){
        $this
            ->setName('app:create:admin')
            ->setDescription('Create a new User Admin')
            ->setHelp('This command creates a new administrator');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);
        $io->newLine();
        $io->block('Welcome to the UnaGauchada user creator', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        $email = $io->ask('User email', null, function($email){
            if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \RuntimeException(
                    'The email is invalid'
                );
            }

            return $email;
        });

        $password = $io->askHidden('User password', null, function ($password) use ($io){
            if( !is_string($password) ){
                throw new \RuntimeException(
                    'Invalid Password'
                );
            }
        });


        $output->writeln($email);
        $output->writeln($password);

        // create the user
    }

}