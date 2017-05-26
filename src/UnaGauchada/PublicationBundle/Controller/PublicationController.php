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
        $repository = $this->getDoctrine()->getRepository('PublicationBundle:Publication');
        $publications = $repository->findAll();
        return $this->render('PublicationBundle:Publications:index.html.twig', array('publications' => $publications));
    }

    public function publicationAction(){
        return $this->render('PublicationBundle:Publications:publication.html.twig');
    }

    public function publishAction(){
       return $this->render('PublicationBundle:Creation:creation.html.twig');
    }

    public function publishCreateAction(Request $request){

        if(!$this->getUser()->getCredits()==0){
            $em = $this->getDoctrine()->getManager();
            $cityRepository = $this->getDoctrine()->getRepository('PublicationBundle:City');
            $categoryRepository = $this->getDoctrine()->getRepository('PublicationBundle:Category');

            $city = $cityRepository->findOneById($request->get('city'));
            $category = $categoryRepository->findOneById($request->get('category'));

            $publication = new Publication();
            $publication
                ->setTitle($request->get('title'))
                ->setDescription($request->get('description'))
                ->setLimitDate(new \DateTime($request->get('limitDate')))
                ->setCategory($category)
                ->setCity($city)
                ->setImageBlob($request->files->get('image'));

            $em->persist($publication);

            $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
            $reason = $repository->findOneByName('Publication');
            $reason->newTransactionFor($this->getUser());

            $em->flush();
            return $this->redirectToRoute('publication_homepage');
        }else{
            return $this->redirectToRoute('publish_new');
        }
    }

    public function imageAction(Publication $publication){
        return new Response(stream_get_contents($publication->getImage()), 200, array('Content-Type' => $publication->getImageMime()));
    }

}
