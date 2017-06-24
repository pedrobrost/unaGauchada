<?php

namespace UnaGauchada\PublicationBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\PublicationBundle\Entity\Achievement;
use UnaGauchada\PublicationBundle\Entity\Category;
use UnaGauchada\CreditBundle\Entity\TransactionReason;
use UnaGauchada\PublicationBundle\Entity\Score;

class LoadAllCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:load:all')
            ->setDescription('Load all')
            ->setHelp('This command loads all');
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
        $io->block('Welcome to the UnaGauchada all loader', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        $em = $this->getManager();

        //Achievements
        $em->persist(new Achievement('Observador', 0, 0));
        $em->persist(new Achievement("Irresponsable", PHP_INT_MIN, -1));
        $em->persist(new Achievement("Buen Tipo", 1, 1));
        $em->persist(new Achievement("Gran tipo", 2, 5));
        $em->persist(new Achievement("Tipazo", 6, 10));
        $em->persist(new Achievement("Héroe", 11, 20));
        $em->persist(new Achievement("Nobleza Gaucha", 21, 50));
        $em->persist(new Achievement("Dios", 51, PHP_INT_MAX));

        //Scores
        $em->persist(new Score('Negativo', -1));
        $em->persist(new Score('Neutro', 0));
        $em->persist(new Score('Positivo', 2));

        //Categories
        $em->persist(new Category("Viajes"));
        $em->persist(new Category("Animales"));
        $em->persist(new Category("Comida"));
        $em->persist(new Category("Plantas"));
        $em->persist(new Category("Autos"));
        $em->persist(new Category("Otros"));

        //Reasons
        $em->persist((new TransactionReason())
            ->setName('Initial')
            ->setAmount(1)
            ->setPrice(0));

        $em->persist((new TransactionReason())
            ->setName('Publication')
            ->setAmount(-1)
            ->setPrice(0));


        $em->persist((new TransactionReason())
            ->setName('Purchase')
            ->setAmount(1)
            ->setPrice(50));

        //Cities
        //mysql -u root -p < src/UnaGauchada/PublicationBundle/Resources/db/departmentsLoader.sql

        $em->flush();

        $io->newLine();
        $io->success('All has been created');
        $io->newLine();
    }

}