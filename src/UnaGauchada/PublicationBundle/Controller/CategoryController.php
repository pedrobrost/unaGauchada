<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UnaGauchada\PublicationBundle\Entity\Publication;

class CategoryController extends Controller{

    public function listAction(){
        $repository = $this->getDoctrine()
            ->getRepository('PublicationBundle:Category');

        $categories = $repository->findAll();
        return $this->render('PublicationBundle:Categories:list.html.twig', array('categories' => $categories));
    }

    public function listDefaultAction(Publication $publication){
        $repository = $this->getDoctrine()
            ->getRepository('PublicationBundle:Category');

        $categories = $repository->findAll();
        return $this->render('PublicationBundle:Categories:listDefault.html.twig', array('categories' => $categories, 'publication' => $publication));
    }

}
