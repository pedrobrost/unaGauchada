<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:55
 */

namespace UnaGauchada\PublicationBundle\Model;


use UnaGauchada\PublicationBundle\Entity\Publication;
use UnaGauchada\PublicationBundle\Service\TransactionService;

class WithoutSubmissionsState extends PublicationSubmissionsState
{
    public function addAvailableIfActive($activePublications){
        $activePublications->add($this->getPublication());
    }

    public function cancel($reason){
        $this->getPublication()->setIsCancelled(true);
        $reason->newTransactionFor($this->getPublication()->getUser());
        return "Tu publicación ha sido cancelada exitosamente, se te ha devuelto un crédito.";
    }

    public function isActive(){
        return true;
    }

}