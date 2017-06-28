<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:51
 */

namespace UnaGauchada\PublicationBundle\Model;


class WaitingState extends SubmissionState
{

    private $submission;


    public function __construct($submission){
        $this->submission = $submission;
    }

    public function getScore(){
        return 0;
    }

    public function isChosen()
    {
        return false;
    }

    public function isWaiting($publication)
    {
        return !($publication->isClosed());
    }

    public function isRejected($publication)
    {
        return $publication->isClosed();
    }
}