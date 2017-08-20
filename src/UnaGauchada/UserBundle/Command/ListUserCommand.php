<?php

namespace UnaGauchada\UserBundle\Command;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\UserBundle\Entity\User;

class ListUserCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:list:users')
            ->setDescription('List all users')
            ->setHelp('This command lists all system users');
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
        $io->title('User\'s list');

        $users = new ArrayCollection($this->getManager()->getRepository('UserBundle:User')->findAll());
        $io->table(
            array('id', 'Name', 'Lastname', 'Email', 'Role' , 'sysDate'),
            $users->map(function (User $user){
                return array(
                    $user->getId(),
                    $user->getName(),
                    $user->getLastName(),
                    $user->getEmail(),
                    $user->isAdmin() ? 'Admin' : 'User',
                    $user->getSysDate()->format("d/m/Y")
                );
            })->toArray()
        );
    }

}