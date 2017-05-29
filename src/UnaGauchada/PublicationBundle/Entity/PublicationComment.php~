<?php

namespace UnaGauchada\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationComment
 *
 * @ORM\Table(name="publication_comment")
 * @ORM\Entity(repositoryClass="UnaGauchada\PublicationBundle\Repository\PublicationCommentRepository")
 */
class PublicationComment extends Comment
{
    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Response")
     * @ORM\JoinColumn(name="response_id", referencedColumnName="id")
     */
    private $response;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return PublicationComment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return PublicationComment
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
     * Set response
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Response $response
     *
     * @return PublicationComment
     */
    public function setResponse(\UnaGauchada\PublicationBundle\Entity\Response $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set user
     *
     * @param \UnaGauchada\UserBundle\Entity\User $user
     *
     * @return PublicationComment
     */
    public function setUser(\UnaGauchada\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UnaGauchada\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
