<?php

namespace UnaGauchada\UserBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\UserBundle\Entity\User;

class CreateAdminCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:create:admin')
            ->setDescription('Create a new User Admin')
            ->setHelp('This command creates a new administrator');
    }

    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

    protected function getManager(): EntityManager
    {
        return $this->getDoctrine()->getManager();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);
        $io->newLine();
        $io->block('Welcome to the UnaGauchada user creator', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        $email = $io->ask('User email', null, function ($email) {
            if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \RuntimeException(
                    'The email is invalid'
                );
            }

            return $email;
        });

        $password = $io->askHidden('User password', null, function ($password) use ($io) {
            if (!is_string($password)) {
                throw new \RuntimeException(
                    'Invalid Password'
                );
            }
        });

        // create the user
        $user = new User();
        $user
            ->setName($io->ask('User name'))
            ->setLastName($io->ask('User lastname'))
            ->setEmail($email)
            ->setIsAdmin(true)
            ->setPlainPassword($password)
            ->setPassword('cunk')
            ->setSalt('cunk')
            ->setBirthday($io->ask('User birthdate', null, function ($date) {
                return new \DateTime($date);
            }));

        $em = $this->getManager();
        $em->persist($user);
        $em->flush();

        $io->newLine();
        $io->success('Admin has been created');
        $io->newLine();
    }

}