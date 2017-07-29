<?php

namespace UnaGauchada\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    public function creditsPriceAction()
    {
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Purchase');
        $actualPrice = $reason->getPrice();
        return $this->render('AdminBundle:CreditsPrice:viewChangeValue.html.twig', array('actualPrice' => $actualPrice));
    }

    public function changeCreditsPriceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $repository->findOneByName('Purchase')->setPrice($request->get('price'));
        $em->flush();

        $price = $request->get('price');
        $price = floor($price) == $price ? floor($price) : $price;
        $this->addFlash('notice', 'El precio de los créditos se ha actualizado a $'.($price + 0).'.');

        return $this->redirectToRoute('publication_homepage');
    }

}
