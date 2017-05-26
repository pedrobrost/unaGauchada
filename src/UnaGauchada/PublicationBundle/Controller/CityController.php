<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UnaGauchada\PublicationBundle\Entity\Publication;

class CityController extends Controller{

    public function listAction(){

        $repository = $this->getDoctrine()
            ->getRepository('PublicationBundle:City');

        $cities = $repository->findAll();

        return $this->render('PublicationBundle:Cities:list.html.twig', array('cities' => $cities));
    }
}
