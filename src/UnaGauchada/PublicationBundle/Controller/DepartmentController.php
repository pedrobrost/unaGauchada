<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UnaGauchada\PublicationBundle\Entity\Publication;

class DepartmentController extends Controller{

    public function listAction(){
        $repository = $this->getDoctrine()
            ->getRepository('PublicationBundle:Department');

        $departments = $repository->findAll();
        return $this->render('PublicationBundle:Cities:list.html.twig', array('departments' => $departments));
    }

    public function listDefaultAction(Publication $publication){
        $repository = $this->getDoctrine()
            ->getRepository('PublicationBundle:Department');

        $departments = $repository->findAll();
        return $this->render('PublicationBundle:Cities:listDefault.html.twig', array('departments' => $departments, 'publication' => $publication));
    }

}
