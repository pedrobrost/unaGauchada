<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicationController extends Controller
{
    public function indexAction()
    {

        return $this->render('PublicationBundle:Publications:index.html.twig', array('publications' => array()));
    }
}
