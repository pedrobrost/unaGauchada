<?php

namespace UnaGauchada\CreditBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\CreditBundle\Entity\TransactionReason;
use UnaGauchada\UserBundle\Entity\User;

class CreateTransactionReasonCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:create:reason')
            ->setDescription('Create a new Transaction Reason')
            ->setHelp('This command creates a new transaction reason');
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
        $io->block('Welcome to the UnaGauchada transaction reason creator', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        // create the user
        $reason = new TransactionReason();
        $reason
            ->setName($io->ask('Name'))
            ->setAmount($io->ask('Amount'))
            ->setPrice($io->ask('Price'));

        $em = $this->getManager();
        $em->persist($reason);
        $em->flush();

        $io->newLine();
        $io->success('Reason has been created');
        $io->newLine();
    }

}