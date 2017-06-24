<?php

namespace UnaGauchada\UserBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use UnaGauchada\UserBundle\Entity\User;
use UnaGauchada\UserBundle\Service\PasswordUpdaterService;


class UserListener implements EventSubscriber
{

    private $passwordUpdater;


    public function __construct(PasswordUpdaterService $passwordUpdater)
    {
        $this->passwordUpdater = $passwordUpdater;
    }
    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'preUpdate',
        );
    }
    /**
     * Pre persist listener based on doctrine common.
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof User) {
            $this->updateUserFields($object);
        }
    }
    /**
     * Pre update listener based on doctrine common.
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof User) {
            $this->updateUserFields($object);
            $this->recomputeChangeSet($args->getObjectManager(), $object);
        }
    }

    /**
     * Updates the user properties.
     *
     * @param UserInterface $user
     */
    private function updateUserFields(User $user)
    {
        $this->passwordUpdater->hashPassword($user);
    }
    /**
     * Recomputes change set for Doctrine implementations not doing it automatically after the event.
     *
     * @param ObjectManager $om
     * @param UserInterface $user
     */
    private function recomputeChangeSet(ObjectManager $om, User $user)
    {
        $meta = $om->getClassMetadata(get_class($user));
        if ($om instanceof EntityManager) {
            $om->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $user);
            return;
        }
    }
}