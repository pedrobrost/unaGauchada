<?php

namespace UnaGauchada\PublicationBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\CreditBundle\Entity\TransactionReason;
use UnaGauchada\PublicationBundle\Entity\City;
use UnaGauchada\UserBundle\Entity\User;

class LoadCitiesCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:load:cities')
            ->setDescription('Load cities')
            ->setHelp('This command loads example cities');
    }

    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

    protected function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);
        $io->newLine();
        $io->block('Welcome to the UnaGauchada example cities loader', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();


        $em = $this->getManager();
        $em->persist(new City("La Plata"));
        $em->persist(new City("Capital"));
        $em->persist(new City("Rosario"));
        $em->persist(new City("Córdoba"));
        $em->persist(new City("Mar del Plata"));
        $em->flush();

        $io->newLine();
        $io->success('Reason has been created');
        $io->newLine();
    }

}