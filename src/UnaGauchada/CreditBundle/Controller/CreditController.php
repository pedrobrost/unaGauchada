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

    public function summaryAction(Request $request)
    {
        return $this->render('CreditBundle::summary.html.twig');
    }

    public function buyAction(Request $request){
        if($request->get('creditCard') != '123456'){
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

}
