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
                'Busco acompañante de viaje',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Reencontrarme con Ramirez',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Busco testigo falso',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Restaurar obra de arte',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Mila para Luis',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            ),
            new Publication(
                'Seba Puto',
                'http://lorempixel.com/600/337/?time=',
                new \DateTime()
            )
        );
        return $this->render('PublicationBundle:Publications:index.html.twig', array('publications' => $publications));

    }
}
