<?php

namespace UnaGauchada\AdminBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UnaGauchada\CreditBundle\Entity\Transaction;
use UnaGauchada\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class AdminController extends Controller
{
    public function rankingAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $query = $repository->createQueryBuilder('p')
            ->where('p.isAdmin = 0')
            ->getQuery();
        $users = $query->getResult();
        return $this->render('AdminBundle:RankingReport:userReport.html.twig', array('users' => $users));
    }

    public function profitAction(Request $request){
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reasonId = $repository->findOneByName('Purchase')->getId();
        $repository = $this->getDoctrine()
            ->getRepository(Transaction::class);

        $qb = $repository->createQueryBuilder('t');
        $qb
            ->where('t.reason = :reason_id')
            ->setParameter('reason_id', $reasonId);
        $transactions = $qb->getQuery()->getResult();

        $dates = null;
        if($request->get('dates')){
            $dates = explode(' - ', $request->get('dates'));
            $from = \DateTime::createFromFormat('d/m/Y', $dates[0]);
            $to = \DateTime::createFromFormat('d/m/Y', $dates[1]);
            $aux = new ArrayCollection();
            foreach ($transactions as $transaction) {
                if( strtotime($transaction->getDate()->format('Y-m-d')) >= strtotime($from->format('Y-m-d')) &&
                    strtotime($transaction->getDate()->format('Y-m-d')) <= strtotime($to->format('Y-m-d')))
                {
                    $aux->add($transaction);
                }
            }
            $transactions = $aux;
            $dates = $request->get('dates');
        }
        return $this->render('AdminBundle:ProfitReport:report.html.twig', array('transactions' => $transactions, 'dates' => $dates));
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