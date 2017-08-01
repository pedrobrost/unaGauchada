<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UnaGauchada\PublicationBundle\Entity\Category;
use UnaGauchada\PublicationBundle\Entity\Publication;

class CategoryController extends Controller{

    public function listAction(){
        $query = $this->getDoctrine()->getRepository(Category::class)->createQueryBuilder('c')
            ->where('c.isDeleted != :deleted')
            ->setParameter('deleted', true)
            ->getQuery();
        $categories = $query->getResult();
        return $this->render('PublicationBundle:Categories:list.html.twig', array('categories' => $categories));
    }

    public function listDefaultAction(Publication $publication){
        $repository = $this->getDoctrine()
            ->getRepository('PublicationBundle:Category');

        $categories = $repository->findAll();
        return $this->render('PublicationBundle:Categories:listDefault.html.twig', array('categories' => $categories, 'publication' => $publication));
    }

}
