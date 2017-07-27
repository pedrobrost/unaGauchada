<?php

namespace UnaGauchada\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function raitingAction()
    {
        return $this->render('AdminBundle:RatingReport:userReport.html.twig');
    }
}
