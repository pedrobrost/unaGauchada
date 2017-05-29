<?php

namespace UnaGauchada\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Response
 *
 * @ORM\Table(name="response")
 * @ORM\Entity(repositoryClass="UnaGauchada\PublicationBundle\Repository\ResponseRepository")
 */
class Response extends Comment
{


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
     * @return Response
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
     * @return Response
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
     * Set user
     *
     * @param \UnaGauchada\UserBundle\Entity\User $user
     *
     * @return Response
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
