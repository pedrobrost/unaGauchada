<?php

namespace UnaGauchada\PublicationBundle\Command;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\PublicationBundle\Entity\Achievement;
use UnaGauchada\PublicationBundle\Entity\Category;
use UnaGauchada\PublicationBundle\Entity\PublicationComment;

class CreateCommentCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('app:create:comment')
            ->setDescription('Create Comment')
            ->setHelp('This command create comments');
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
        $io->block('Welcome to the UnaGauchada comment creator', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneById('2');

        $publication = $this->getDoctrine()->getRepository('PublicationBundle:Publication')->findOneById('1');

        $comment = new PublicationComment();
        $comment
            ->setUser($user)
            ->setDate(new \DateTime())
            ->setText("Esto es un comentario de prueba")
            ->setPublication($publication);


        $publication->addPublicationsComment($comment);

        $em = $this->getManager();
        $em->persist($publication);
        $em->flush();

        $io->newLine();
        $io->success('Comment has been created');
        $io->newLine();
    }

}