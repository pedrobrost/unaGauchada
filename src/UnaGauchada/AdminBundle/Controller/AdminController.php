<?php

namespace UnaGauchada\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UnaGauchada\UserBundle\Entity\User;

class AdminController extends Controller
{
    public function ratingAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $query = $repository->createQueryBuilder('p')
            ->where('p.isAdmin = 0')
            ->getQuery();
        $users = $query->getResult();
        return $this->render('AdminBundle:RatingReport:userReport.html.twig', array('users' => $users));
    }

    public function profitAction(){
        return $this->render('AdminBundle:ProfitReport:report.html.twig');
    }

}
