<?php

namespace UnaGauchada\PublicationBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\PublicationBundle\Entity\Achievement;
use UnaGauchada\PublicationBundle\Entity\Category;

class LoadAchievementsCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:load:achievements')
            ->setDescription('Load achievements')
            ->setHelp('This command loads achievements');
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
        $io->block('Welcome to the UnaGauchada achievements loader', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        $em = $this->getManager();
        $em->persist(new Achievement('Observador', 0, 0));
        $em->persist(new Achievement("Irresponsable", PHP_INT_MIN, -1));
        $em->persist(new Achievement("Buen Tipo", 1, 1));
        $em->persist(new Achievement("Gran tipo", 2, 5));
        $em->persist(new Achievement("Tipazo", 6, 10));
        $em->persist(new Achievement("Héroe", 11, 20));
        $em->persist(new Achievement("Nobleza Gaucha", 21, 50));
        $em->persist(new Achievement("Dios", 51, PHP_INT_MAX));
        $em->flush();

        $io->newLine();
        $io->success('Achievements has been created');
        $io->newLine();
    }

}