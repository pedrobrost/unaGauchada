<?php

namespace UnaGauchada\PublicationBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\PersistentCollection;
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
    public function indexAction(Request $request, $page)
    {
        $repository = $this->getDoctrine()->getRepository('PublicationBundle:Publication');
        $publications = $repository->findAll();
        $publications = new ArrayCollection($publications);
        $publications = $this->getActive($publications);
        $pages = ceil($publications->count() / 9);
        $pages = ($pages == 0) ? 1 : $pages;
        $publications = $publications->matching(Criteria::create()
            ->orderBy(array('sysDate' => Criteria::DESC))
            ->setFirstResult(($page - 1) * 9)
            ->setMaxResults(9)
        );

        $publicationCreated = $request->getSession()->get('publicationCreated', false);
        $request->getSession()->remove('publicationCreated');
        $publicationCancelled = $request->getSession()->get('publicationCancelled', false);
        $request->getSession()->remove('publicationCancelled');
        return $this->render('PublicationBundle:Publications:index.html.twig', array('publications' => $this->getActive($publications), 'page' => $page, 'pages' => $pages, 'publicationCreated' => $publicationCreated, 'publicationCancelled' => $publicationCancelled));
    }

    public function getActive($publications)
    {
        $activePublications = new ArrayCollection();
        foreach ($publications as $publication) {
            $publication->addIfActive($activePublications);
        }
        return $activePublications;
    }

    public function showAction(Publication $publication, Request $request)
    {
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

    public function publishCreateAction(Request $request)
    {

        if (!$this->getUser()->getCredits() == 0) {
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
        } else {
            return $this->redirectToRoute('publish_new');
        }
    }

    public function imageAction(Publication $publication)
    {
        if (!$publication->getImage()) {
            $file = new File(__DIR__ . '/../Resources/public/image/logocard.jpg');
            $imageFile = fopen($file->getRealPath(), 'r');
            $imageContent = fread($imageFile, $file->getSize());
            fclose($imageFile);
            return new Response($imageContent, 200, array('Content-Type' => $file->getMimeType()));
        }
        return new Response(stream_get_contents($publication->getImage()), 200, array('Content-Type' => $publication->getImageMime()));
    }

    public function commentAction(Publication $publication, Request $request)
    {
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

    public function responseAction(Publication $publication, Comment $comment, Request $request)
    {
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

    public function searchAction(Request $request, $page)
    {

        $repository = $this->getDoctrine()->getRepository('PublicationBundle:Publication');
        $publications = new ArrayCollection($repository->findAll());

        $criteria = Criteria::create()
            ->orderBy(array('sysDate' => Criteria::DESC));

        if ($request->get('title', "") != ""){
            $title = strtolower($request->get('title'));
            $query = $repository->createQueryBuilder('p')
                ->where("LOWER(p.title) LIKE :title")
                ->setParameter('title', '%'.$title.'%')
                ->getQuery();
            $publications = $query->getResult();
            $publications = new ArrayCollection($publications);
        }

        if ($request->get('city', -1) != -1) {
            $departmentRepository = $this->getDoctrine()->getRepository('PublicationBundle:Department');
            $department = $departmentRepository->findOneById($request->get('city'));
            $criteria->andWhere(Criteria::expr()->eq('department', $department));
        }

        if ($request->get('category', -1) != -1) {
            $categoryRepository = $this->getDoctrine()->getRepository('PublicationBundle:Category');
            $category = $categoryRepository->find($request->get('category'));
            $criteria->andWhere(Criteria::expr()->eq('category', $category));
        }

        $categories = $this->getDoctrine()
            ->getRepository('PublicationBundle:Category')->findAll();
        $departments = $this->getDoctrine()
            ->getRepository('PublicationBundle:Department')->findAll();

        $publications = $this->getActive($publications);
        $publications = $publications->matching($criteria);
        $amount = $publications->count();
        $pages = ceil($publications->count() / 6);
        $pages = ($pages == 0) ? 1 : $pages;
        $publications = $publications->matching(Criteria::create()
            ->setFirstResult(($page - 1) * 6)
            ->setMaxResults(6)
        );

        return $this->render('PublicationBundle:Search:advancedSearch.html.twig', array('publications' => $publications, 'amount' => $amount, 'page' => $page, 'pages' => $pages, 'categories' => $categories, 'departments' => $departments));
    }

    public function submitAction(Publication $publication, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $submission = new Submission($this->getUser(), $publication);
        if ($request->get('message') != "") {
            $submission->setMessage($request->get('message'));
        }
        $em->persist($submission); // ver si se puede sacar
        $em->flush();

        $request->getSession()->set('postulated', true);
        return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
    }

    public function cancelAction(Publication $publication, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Refund');
        $message = $publication->cancel($reason);
        $this->getDoctrine()->getManager()->flush();

        $request->getSession()->set('publicationCancelled', $message);
        return $this->redirectToRoute('publication_homepage');
    }

    public function showEditAction(Publication $publication){
        $this->denyAccessUnlessGranted('edit', $publication);
        return $this->render('PublicationBundle:EditPublication:editPublication.html.twig', array('publication' => $publication));
    }

    public function editAction(Publication $publication, Request $request){
        $this->denyAccessUnlessGranted('edit', $publication);

        $em = $this->getDoctrine()->getManager();
        $departmentRepository = $this->getDoctrine()->getRepository('PublicationBundle:Department');
        $categoryRepository = $this->getDoctrine()->getRepository('PublicationBundle:Category');

        $department = $departmentRepository->findOneById($request->get('city'));
        $category = $categoryRepository->findOneById($request->get('category'));

        $publication
            ->setTitle($request->get('title'))
            ->setDescription($request->get('description'))
            ->setCategory($category)
            ->setDepartment($department);

        if($request->files->get('image'))
            $publication->setImageBlob($request->files->get('image'));

        $em->flush();

        /*
        $request->getSession()->set('publicationCreated', true);
        return $this->redirectToRoute('publication_homepage');
        */

        $this->addFlash('edit', 'Tu publicación se modificó exitosamente.');
        return $this->redirectToRoute('publication_show', array('id' => $publication->getId()));
    }

}
