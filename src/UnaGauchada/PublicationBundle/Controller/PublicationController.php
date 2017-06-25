<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use UnaGauchada\PublicationBundle\Entity\Comment;
use UnaGauchada\PublicationBundle\Entity\Publication;
use UnaGauchada\PublicationBundle\Entity\PublicationComment;
use Symfony\Component\HttpFoundation\Response;
use UnaGauchada\PublicationBundle\Entity\Response as CommentResponse;
use UnaGauchada\PublicationBundle\Entity\Submission;

class PublicationController extends Controller
{
    public function indexAction(Request $request, $page){
        $repository = $this->getDoctrine()->getRepository('PublicationBundle:Publication');
        $publications = $repository->findAll();
        $publications = new ArrayCollection($publications);
        $pages = ceil($publications->count() / 9);
        $pages = ($pages == 0) ? 1 : $pages;
        $publications = $publications->matching(Criteria::create()
                                ->orderBy(array('sysDate' => Criteria::DESC))
                                ->setFirstResult(($page-1) * 9)
                                ->setMaxResults(9)
                        );

        $publicationCreated = $request->getSession()->get('publicationCreated', false);
        $request->getSession()->remove('publicationCreated');
        return $this->render('PublicationBundle:Publications:index.html.twig', array('publications' => $publications, 'page' => $page, 'pages' => $pages, 'publicationCreated' => $publicationCreated));
    }

    public function showAction(Publication $publication, Request $request){
        $commentCreated = $request->getSession()->get('commentCreated', false);
        $request->getSession()->remove('commentCreated');

        $responseCreated = $request->getSession()->get('responseCreated', false);
        $request->getSession()->remove('responseCreated');

        $postulated = $request->getSession()->get('postulated', false);
        $request->getSession()->remove('postulated');

        return $this->render('PublicationBundle:Publications:publication.html.twig', array('publication' => $publication,
                                                                                                'commentCreated' => $commentCreated,
                                                                                                'responseCreated' => $responseCreated,
                                                                                                'postulated' => $postulated));
    }

public function publishAction(){
     return $this->render('PublicationBundle:Creation:creation.html.twig');
    }

    public function publishCreateAction(Request $request){

        if(!$this->getUser()->getCredits()==0){
            $em = $this->getDoctrine()->getManager();
            $departmentRepository = $this->getDoctrine()->getRepository('PublicationBundle:Department');
            $categoryRepository = $this->getDoctrine()->getRepository('PublicationBundle:Category');

            $department = $departmentRepository->findOneById($request->get('city'));
            $category = $categoryRepository->findOneById($request->get('category'));

            $publication = new Publication();
            $publication
                ->setUser($this->getUser())
                ->setTitle($request->get('title'))
                ->setDescription($request->get('description'))
                ->setLimitDate(new \DateTime($request->get('limitDate')))
                ->setCategory($category)
                ->setDepartment($department)
                ->setImageBlob($request->files->get('image'));

            $em->persist($publication);
            $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
            $reason = $repository->findOneByName('Publication');
            $reason->newTransactionFor($this->getUser());
            $em->flush();

            $request->getSession()->set('publicationCreated', true);
            return $this->redirectToRoute('publication_homepage');
        }else{
            return $this->redirectToRoute('publish_new');
        }
    }

    public function imageAction(Publication $publication){
        if(!$publication->getImage()){
            $file = new File(__DIR__.'/../Resources/public/image/logocard.jpg');
            $imageFile = fopen($file->getRealPath(), 'r');
            $imageContent = fread($imageFile, $file->getSize());
            fclose($imageFile);
            return new Response($imageContent, 200, array('Content-Type' => $file->getMimeType()));
        }
        return new Response(stream_get_contents($publication->getImage()), 200, array('Content-Type' => $publication->getImageMime()));
    }

    public function commentAction(Publication $publication, Request $request){
        $comment = new PublicationComment();
        $comment
            ->setUser($this->getUser())
            ->setDate(new \DateTime())
            ->setText($request->get('message'))
            ->setPublication($publication);
        $publication->addPublicationsComment($comment);

        $em = $this->getDoctrine()->getManager();
        $em->persist($publication);
        $em->flush();

        $request->getSession()->set('commentCreated', true);
        return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
    }

    public function responseAction(Publication $publication, Comment $comment,  Request $request){
        $response = new CommentResponse();
        $response->setUser($this->getUser())
            ->setDate(new \DateTime())
            ->setText($request->get('message'));
        $comment->setResponse($response);
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $request->getSession()->set('responseCreated', true);
        return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
    }
    
    public function searchAction(){

    }

    public function submissionsAction(Publication $publication){
        return $this->render('PublicationBundle:Submissions:list.html.twig');
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

}
