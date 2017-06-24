<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UnaGauchada\PublicationBundle\Entity\AcceptedState;
use UnaGauchada\PublicationBundle\Entity\Publication;
use UnaGauchada\PublicationBundle\Entity\Submission;

class SubmissionController extends Controller{

    public function submissionsAction(Publication $publication){
        $this->denyAccessUnlessGranted('edit', $publication);
        $chosen = $publication->getChosen();
        return $this->render('PublicationBundle:Submissions:list.html.twig', array('publication' => $publication, 'chosen' => $chosen));
    }

    public function submitAction(Publication $publication, Request $request){
        $em = $this->getDoctrine()->getManager();
        $submission = new Submission($this->getUser(), $publication);
        if($request->get('message') != ""){
            $submission->setMessage($request->get('message'));
        }
        $em->persist($submission); // ver si se puede sacar
        $em->flush();

        $request->getSession()->set('postulated', true);
        return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
    }

    public function chooseAction(Publication $publication, Submission $submission){
        $this->denyAccessUnlessGranted('edit', $publication);
        $em = $this->getDoctrine()->getManager();
        $submission->setAcceptedState(new AcceptedState($submission));
        $em->flush();

        return $this->redirectToRoute('submissions_show', array('id' => $publication->getId()));
    }

    public function scoreAction(Publication $publication, Submission $submission, Request $request){
        $em = $this->getDoctrine()->getManager();
        $scoreRepository = $this->getDoctrine()->getRepository('PublicationBundle:Score');
        $score = $scoreRepository->findOneByName($request->get('score'));
        $score->newRateFor($submission, $request->get('message'));
        $em->flush();

        return $this->redirectToRoute('submissions_show', array('id' => $publication->getId()));
    }

}
