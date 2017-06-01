<?php

namespace UnaGauchada\PublicationBundle\Command;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnaGauchada\PublicationBundle\Entity\Achievement;
use UnaGauchada\PublicationBundle\Entity\Category;
use UnaGauchada\PublicationBundle\Entity\Publication;
use UnaGauchada\PublicationBundle\Entity\PublicationComment;
use UnaGauchada\PublicationBundle\Entity\Response;
use UnaGauchada\UserBundle\Entity\User;

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

        $users = new ArrayCollection($this->getManager()->getRepository('UserBundle:User')->findAll());
        $io->table(
            array('id', 'Name', 'Lastname', 'Email', 'Role' , 'sysDate'),
            $users->map(function (User $user){
                return array(
                    $user->getId(),
                    $user->getEmail()
                );
            })->toArray()
        );

        $user = $this->getDoctrine()->getRepository('UserBundle:User')->findOneById($io->ask('User id'));

        $publications = new ArrayCollection($this->getManager()->getRepository('PublicationBundle:Publication')->findAll());
        $io->table(
            array('id', 'Name', 'Lastname', 'Email', 'Role' , 'sysDate'),
            $publications->map(function (Publication $publication){
                return array(
                    $publication->getId(),
                    $publication->getTitle()
                );
            })->toArray()
        );

        $publication = $this->getDoctrine()->getRepository('PublicationBundle:Publication')->findOneById($io->ask('Publication id'));

        $comment = new PublicationComment();
        $comment
            ->setUser($user)
            ->setDate(new \DateTime())
            ->setText($io->ask('Comment text'))
            ->setPublication($publication);


        $publication->addPublicationsComment($comment);

        if($io->confirm('Agregar respuesta')){
            $response = new Response();
            $response->setUser($publication->getUser())
                ->setDate(new \DateTime())
                ->setText($io->ask('Comment text'));
             $comment->setResponse($response);
        }


        $em = $this->getManager();
        $em->persist($publication);
        $em->flush();

        $io->newLine();
        $io->success('Comment has been created');
        $io->newLine();
    }

}