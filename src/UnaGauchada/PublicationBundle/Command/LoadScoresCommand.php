<?php

namespace UnaGauchada\PublicationBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\PublicationBundle\Entity\Achievement;
use UnaGauchada\PublicationBundle\Entity\Category;
use UnaGauchada\PublicationBundle\Entity\Score;

class LoadScoresCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:load:scores')
            ->setDescription('Load scores')
            ->setHelp('This command loads scores');
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
        $io->block('Welcome to the UnaGauchada scores loader', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        $em = $this->getManager();
        $em->persist(new Score('negative', -1));
        $em->persist(new Score('neutral', 0));
        $em->persist(new Score('positive', 2));
        $em->flush();

        $io->newLine();
        $io->success('Scores has been created');
        $io->newLine();
    }

}