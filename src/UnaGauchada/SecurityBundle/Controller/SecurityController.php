<?php

namespace UnaGauchada\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('UserBundle:Login:login.html.twig', array('error' => $error, 'lastUsername' => $lastUsername));
    }

}
