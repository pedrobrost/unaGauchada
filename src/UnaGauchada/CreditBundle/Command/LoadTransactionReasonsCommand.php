<?php

namespace UnaGauchada\CreditBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\CreditBundle\Entity\TransactionReason;
use UnaGauchada\UserBundle\Entity\User;

class LoadTransactionReasonsCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:load:reasons')
            ->setDescription('Load Transaction Reasons')
            ->setHelp('This command loads transaction reasons');
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
        $io->block('Welcome to the UnaGauchada transaction reasons loader', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();


        $em = $this->getManager();
        $em->persist((new TransactionReason())
            ->setName('Initial')
            ->setAmount(1)
            ->setPrice(0));
        $em->persist((new TransactionReason())
            ->setName('Publication')
            ->setAmount(-1)
            ->setPrice(0));

        $em->flush();

        $io->newLine();
        $io->success('Reasons has been loaded');
        $io->newLine();
    }

}