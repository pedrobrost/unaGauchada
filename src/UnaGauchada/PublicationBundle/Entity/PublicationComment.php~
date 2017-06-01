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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="publicationsComments")
     * @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     */
    private $publication;



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
     * Set publication
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Publication $publication
     *
     * @return PublicationComment
     */
    public function setPublication(\UnaGauchada\PublicationBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }
}
