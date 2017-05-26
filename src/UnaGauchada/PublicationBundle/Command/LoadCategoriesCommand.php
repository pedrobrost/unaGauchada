<?php

namespace UnaGauchada\PublicationBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\CreditBundle\Entity\TransactionReason;
use UnaGauchada\PublicationBundle\Entity\Category;
use UnaGauchada\PublicationBundle\Entity\City;
use UnaGauchada\UserBundle\Entity\User;

class LoadCategoriesCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:load:categories')
            ->setDescription('Load categories')
            ->setHelp('This command loads example categories');
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
        $io->block('Welcome to the UnaGauchada example categories loader', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();


        $em = $this->getManager();
        $em->persist(new Category("Viajes"));
        $em->persist(new Category("Animales"));
        $em->persist(new Category("Comida"));
        $em->persist(new Category("Plantas"));
        $em->persist(new Category("Autos"));
        $em->flush();

        $io->newLine();
        $io->success('Reason has been created');
        $io->newLine();
    }

}