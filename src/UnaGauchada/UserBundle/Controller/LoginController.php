<?php

namespace UnaGauchada\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    public function loginAction(Request $request)
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('UserBundle:Login:login.html.twig', array('error' => $error, 'lastUsername' => $lastUsername));
    }

    public function testAction(){

        $passwordUpdater = $this->container->get('api.users.password_updater');

        $user= $this->getDoctrine()->getRepository('UserBundle:User')->find(1);

        $encoded = $passwordUpdater->encodePassword($user, '1234');

        return var_dump(array('1' => $user->getPassword(),
        '2' => $encoded));
    }

}
