<?php

namespace UnaGauchada\UserBundle\Service;

use UnaGauchada\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class PasswordUpdaterService{

    private $encoderFactory;


    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function hashPassword(User $user)
    {
        $plainPassword = $user->getPlainPassword();
        if (0 === strlen($plainPassword)) {
            return;
        }

        $encoder = $this->encoderFactory->getEncoder($user);

        $user->setSalt(rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '='));

        $hashedPassword = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($hashedPassword);
        $user->eraseCredentials();
    }

    public function encodePassword($user, $pass){
        $encoder = $this->encoderFactory->getEncoder($user);

        $user->setSalt(rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '='));

        return $encoder->encodePassword($pass, $user->getSalt());

    }

}