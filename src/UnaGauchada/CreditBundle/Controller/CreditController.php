<?php

namespace UnaGauchada\CreditBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreditController extends Controller
{
    public function selectAmountAction()
    {
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Purchase');
        return $this->render('CreditBundle::amount.html.twig', array('price' => $reason->getPrice()));
    }

    public function userInfoAction(Request $request)
    {
        return $this->render('CreditBundle::userInfo.html.twig', array('amount' => $request->get('amount')));
    }

    public function summaryAction()
    {
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Purchase');
        return $this->render('CreditBundle::summary.html.twig', array('price' => $reason->getPrice()));
    }

    public function buyAction(Request $request){
        if($request->get('creditCard') == '654321'){
            return $this->render('CreditBundle::success.html.twig', array('success' => array('creditCard' => true, 'bank' => false)));
        }else if($request->get('creditCard') != '123456' | $this->invalidDate($request->get('month'), $request->get('year'))){
            return $this->render('CreditBundle::success.html.twig', array('success' => array('creditCard' => false, 'bank' => true)));
        }
        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Purchase');
        $reason->newTransactionFor($this->getUser(), $request->get('amount'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($this->getUser());
        $em->flush();

        return $this->render('CreditBundle::success.html.twig', array('success' => array('creditCard' => true, 'bank' => true)));
    }

    public function invalidDate($month, $year){
        return ($year == date("Y") && $month <= date("m"));
    }

}
