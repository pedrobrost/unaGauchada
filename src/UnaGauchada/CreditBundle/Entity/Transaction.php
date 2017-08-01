<?php

namespace UnaGauchada\CreditBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="UnaGauchada\CreditBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @var int
     *
     * @ORM\Column(name="amountOfCredits", type="integer")
     */
    private $amountOfCredits;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="UnaGauchada\UserBundle\Entity\User", inversedBy="transactions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many Transactions have One User.
     * @ORM\ManyToOne(targetEntity="TransactionReason", inversedBy="transactions")
     * @ORM\JoinColumn(name="reason_id", referencedColumnName="id")
     */
    private $reason;


    public function __construct($reason, $user){
        $this->reason = $reason;
        $this->date = new \DateTime();
        $this->user = $user;
    }

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transaction
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
     * Set amountOfCredits
     *
     * @param integer $amountOfCredits
     *
     * @return Transaction
     */
    public function setAmountOfCredits($amountOfCredits)
    {
        $this->amountOfCredits = $amountOfCredits;

        return $this;
    }

    /**
     * Get amountOfCredits
     *
     * @return integer
     */
    public function getAmountOfCredits()
    {
        return $this->amountOfCredits;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Transaction
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set user
     *
     * @param \UnaGauchada\UserBundle\Entity\User $user
     *
     * @return Transaction
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
     * Set reason
     *
     * @param \UnaGauchada\CreditBundle\Entity\TransactionReason $reason
     *
     * @return Transaction
     */
    public function setReason(\UnaGauchada\CreditBundle\Entity\TransactionReason $reason = null)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get reason
     *
     * @return \UnaGauchada\CreditBundle\Entity\TransactionReason
     */
    public function getReason()
    {
        return $this->reason;
    }

    public function getTotalPrice(){
        return $this->getPrice() * $this->getAmountOfCredits();
    }

}
