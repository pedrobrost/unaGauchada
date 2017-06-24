<?php

namespace UnaGauchada\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UnaGauchada\PublicationBundle\Model\SubmissionState;

/**
 * AcceptedState
 *
 * @ORM\Table(name="accepted")
 * @ORM\Entity(repositoryClass="UnaGauchada\PublicationBundle\Repository\AcceptedRepository")
 */
class AcceptedState extends SubmissionState
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Rate")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id", nullable=true)
     */
    private $rate;

    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="Submission", inversedBy="acceptedState")
     * @ORM\JoinColumn(name="submission_id", referencedColumnName="id")
     */
    private $submission;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return AcceptedState
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set rate
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Rate $rate
     *
     * @return AcceptedState
     */
    public function setRate(\UnaGauchada\PublicationBundle\Entity\Rate $rate = null)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Rate
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set submission
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Submission $submission
     *
     * @return AcceptedState
     */
    public function setSubmission(\UnaGauchada\PublicationBundle\Entity\Submission $submission = null)
    {
        $this->submission = $submission;

        return $this;
    }

    /**
     * Get submission
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Submission
     */
    public function getSubmission()
    {
        return $this->submission;
    }

    public function getScore(){
        if(!$this->getRate()){
            return $this->getRate()->getPoints();
        }else{
            return 0;
        }
    }

}
