<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:53
 */

namespace UnaGauchada\PublicationBundle\Model;


use UnaGauchada\PublicationBundle\Entity\Publication;

class AvailableState extends PublicationAvailableState
{

    public function addIfActive($activePublications, Publication $publication){
        $publication->getSubmissionsState()->addAvailableIfActive($activePublications, $publication);
    }

}