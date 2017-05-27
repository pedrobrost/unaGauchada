<?php

namespace UnaGauchada\CreditBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CreditController extends Controller
{
    public function purchaseAction()
    {
        return $this->render('CreditBundle::purchase.html.twig');
    }

    public function buyAction(Request $request){

        $repository = $this->getDoctrine()->getRepository('CreditBundle:TransactionReason');
        $reason = $repository->findOneByName('Purchase');
        $reason->newTransactionFor($this->getUser(), $request->get('amount'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($this->getUser());
        $em->flush();
        return $this->render('CreditBundle::success.html.twig');
    }

}
