<?php

namespace UnaGauchada\CreditBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreditController extends Controller
{
    public function selectAmountAction()
    {
        return $this->render('CreditBundle::amount.html.twig');
    }

    public function userInfoAction(Request $request)
    {
        return $this->render('CreditBundle::userInfo.html.twig', array('amount' => $request->get('amount')));
    }

    public function summaryAction()
    {
        return $this->render('CreditBundle::summary.html.twig');
    }

    public function buyAction(Request $request){
        if($request->get('creditCard') != '123456' | $this->invalidDate($request->get('month'), $request->get('year'))){
            return $this->render('CreditBundle::success.html.twig', array('success' => false));
        }
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Purchase');
        $reason->newTransactionFor($this->getUser(), $request->get('amount'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($this->getUser());
        $em->flush();


        return $this->render('CreditBundle::success.html.twig', array('success' => true));
    }

    public function invalidDate($month, $year){
        return ($year == date("Y") && $month <= date("m"));
    }

}
