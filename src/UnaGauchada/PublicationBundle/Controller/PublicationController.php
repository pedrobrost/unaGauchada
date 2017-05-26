<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UnaGauchada\PublicationBundle\Entity\Publication;

class PublicationController extends Controller
{
    public function indexAction()
    {

        $publications = array(
            new Publication(
                'Una milanga para los pi',
                'http://www.pasqualinonet.com.ar/Images5/Milanesa-napo-1920w.jpg?a=',
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
                'Busco acompañante de viaje',
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

    public function publicationAction(){
        return $this->render('PublicationBundle:Publications:publication.html.twig');
    }

    public function publishAction(){
       return $this->render('PublicationBundle:Creation:creation.html.twig');
    }

    public function publishCreateAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $cityRepository = $this->getDoctrine()->getRepository('PublicationBundle:City');
        $categoryRepository = $this->getDoctrine()->getRepository('PublicationBundle:Category');

        $city = $cityRepository->findOneById($request->get('city'));
        $category = $categoryRepository->findOneById($request->get('category'));

        // create the user
        $publication = new Publication();
        $publication
            ->setTitle($request->get('title'))
            ->setDescription($request->get('description'))
            ->setLimitDate(new \DateTime($request->get('limitDate')))
            ->setCategory($category)
            ->setCity($city)
            ->setImageBlob($request->files->get('image'));

        $em->persist($publication);
        $em->flush();
        return $this->redirectToRoute('publication_homepage');
    }

    public function imageAction(Publication $publication){
        return new Response(stream_get_contents($publication->getImage()), 200, array('Content-Type' => $publication->getImageMime()));
    }

}
