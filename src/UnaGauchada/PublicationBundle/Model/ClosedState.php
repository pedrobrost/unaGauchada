<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:55
 */

namespace UnaGauchada\PublicationBundle\Model;


class ClosedState extends PublicationSubmissionsState
{
    public function isClosed(){
        return true;
    }

    public function isActive(){
        return false;
    }

}