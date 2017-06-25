<?php

namespace UnaGauchada\PublicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use UnaGauchada\UserBundle\Entity\User;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="UnaGauchada\PublicationBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="imageMime", type="string", length=64, nullable=true)
     */
    private $imageMime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sysDate", type="datetime")
     */
    private $sysDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="limitDate", type="datetime")
     */
    private $limitDate;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="UnaGauchada\PublicationBundle\Entity\Submission", mappedBy="publication")
     */
    private $submissions;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="publications")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="Department", inversedBy="publications")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    private $department;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="UnaGauchada\UserBundle\Entity\User", inversedBy="publications")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="PublicationComment", mappedBy="publication", cascade={"persist", "remove"})
     */
    private $publicationsComments;


    public function __construct(){
        $this->submissions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sysDate = new \DateTime();
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
     * Set title
     *
     * @param string $title
     *
     * @return Publication
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publication
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Publication
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function setImageBlob($file)
    {
        if (!$file){
            $this->setImage(null);
            $this->setImageMime(null);
            return $this;
        }
        if(!$file->isValid()){
            throw new FileException("Invalid File");
        }
        $imageFile    = fopen($file->getRealPath(), 'r');
        $imageContent = fread($imageFile, $file->getClientSize());
        fclose($imageFile);
        $this->setImage($imageContent);
        $this->setImageMime($file->getMimeType());
        return $this;
    }


    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set sysDate
     *
     * @param \DateTime $sysDate
     *
     * @return Publication
     */
    public function setSysDate($sysDate)
    {
        $this->sysDate = $sysDate;

        return $this;
    }

    /**
     * Get sysDate
     *
     * @return \DateTime
     */
    public function getSysDate()
    {
        return $this->sysDate;
    }

    /**
     * Set limitDate
     *
     * @param \DateTime $limitDate
     *
     * @return Publication
     */
    public function setLimitDate($limitDate)
    {
        $this->limitDate = $limitDate;

        return $this;
    }

    /**
     * Get limitDate
     *
     * @return \DateTime
     */
    public function getLimitDate()
    {
        return $this->limitDate;
    }

    /**
     * Set imageMime
     *
     * @param string $photoMime
     *
     * @return Publication
     */
    public function setPhotoMime($photoMime)
    {
        $this->imageMime = $photoMime;

        return $this;
    }

    /**
     * Get imageMime
     *
     * @return string
     */
    public function getPhotoMime()
    {
        return $this->imageMime;
    }


    /**
     * Set imageMime
     *
     * @param string $imageMime
     *
     * @return Publication
     */
    public function setImageMime($imageMime)
    {
        $this->imageMime = $imageMime;

        return $this;
    }

    /**
     * Get imageMime
     *
     * @return string
     */
    public function getImageMime()
    {
        return $this->imageMime;
    }

    /**
     * Add submission
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Submission $submission
     *
     * @return Publication
     */
    public function addSubmission(\UnaGauchada\PublicationBundle\Entity\Submission $submission)
    {
        $this->submissions[] = $submission;

        return $this;
    }

    /**
     * Remove submission
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Submission $submission
     */
    public function removeSubmission(\UnaGauchada\PublicationBundle\Entity\Submission $submission)
    {
        $this->submissions->removeElement($submission);
    }

    /**
     * Get submissions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubmissions()
    {
        return $this->submissions;
    }

    /**
     * Set category
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Category $category
     *
     * @return Publication
     */
    public function setCategory(\UnaGauchada\PublicationBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \UnaGauchada\UserBundle\Entity\User $user
     *
     * @return Publication
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


    /**
     * Set department
     *
     * @param \UnaGauchada\PublicationBundle\Entity\Department $department
     *
     * @return Publication
     */
    public function setDepartment(\UnaGauchada\PublicationBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \UnaGauchada\PublicationBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Add publicationsComment
     *
     * @param \UnaGauchada\PublicationBundle\Entity\PublicationComment $publicationsComment
     *
     * @return Publication
     */
    public function addPublicationsComment(\UnaGauchada\PublicationBundle\Entity\PublicationComment $publicationsComment)
    {
        $this->publicationsComments[] = $publicationsComment;

        return $this;
    }

    /**
     * Remove publicationsComment
     *
     * @param \UnaGauchada\PublicationBundle\Entity\PublicationComment $publicationsComment
     */
    public function removePublicationsComment(\UnaGauchada\PublicationBundle\Entity\PublicationComment $publicationsComment)
    {
        $this->publicationsComments->removeElement($publicationsComment);
    }

    /**
     * Get publicationsComments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublicationsComments()
    {
        return $this->publicationsComments;
    }

}
