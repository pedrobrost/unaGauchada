<?php

namespace UnaGauchada\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="UnaGauchada\PublicationBundle\Repository\RateRepository")
 */
class Rate
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
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="Score")
     * @ORM\JoinColumn(name="score_id", referencedColumnName="id")
     */
    private $score;


    public function __construct(Score $score, $message){
        $this->setScore($score);
        $this->setDate(new \DateTime());
        $this->setMessage($message);
    }

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
     * Set message
     *
     * @param string $message
     *
     * @return Rate
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Rate
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
     * Set score
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Score $score
     *
     * @return Rate
     */
    public function setScore(\UnaGauchada\PublicationBundle\Entity\Score $score = null)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Score
     */
    public function getScore()
    {
        return $this->score;
    }

    public function getPoints(){
        return $this->getScore()->getPoints();
    }

}
