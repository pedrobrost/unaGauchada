<?php

namespace UnaGauchada\ClientTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('signUp/signUp.html.twig');
    }
}
