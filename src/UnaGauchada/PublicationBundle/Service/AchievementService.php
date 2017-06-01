<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 27/05/17
 * Time: 01:54
 */

namespace UnaGauchada\PublicationBundle\Service;


use Doctrine\ORM\EntityManager;
use UnaGauchada\UserBundle\Entity\User;

class AchievementService{

    private $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function getFor(User $user){
        return $this->em->getRepository('PublicationBundle:Achievement')->findFor($user);
    }

}