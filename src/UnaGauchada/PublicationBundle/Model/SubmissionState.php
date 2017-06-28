<?php
/**
 * Created by PhpStorm.
 * User: pedro
 * Date: 25/05/17
 * Time: 16:50
 */

namespace UnaGauchada\PublicationBundle\Model;


abstract class SubmissionState
{
    abstract public function getScore();
    abstract public function isChosen();
    abstract public function isWaiting($publication);
    abstract public function isRejected($publication);
    abstract public function getScoreMessage();
}