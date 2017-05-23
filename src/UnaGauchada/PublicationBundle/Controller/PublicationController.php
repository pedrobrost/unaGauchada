<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UnaGauchada\PublicationBundle\Entity\Publication;

class PublicationController extends Controller
{
    public function indexAction()
    {
        $publications = array(
            new Publication(
                'Mila para Luis',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Mila para Luis',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Mila para Luis',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Mila para Luis',
                'img/logocard.jpg',
                new \DateTime()
            ),
            new Publication(
                'Mila para Luis',
                'http://car-bone.pl/wp-content/uploads/2015/01/carbone_poster_100x70_porsche_935_4a_vertical_prev.png',
                new \DateTime()
            ),
            new Publication(
                'Mila para Luis',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            )
        );

        return $this->render('PublicationBundle:Publications:index.html.twig', array('publications' => $publications));
    }
}
