<?php

namespace UnaGauchada\ClientTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('signIn/signIn.html.twig');
    }
}
