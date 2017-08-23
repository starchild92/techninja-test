<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 *
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 */
class Account
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
     * @ORM\Column(name="number", type="string", length=20, nullable=false, unique=true)
     */
    private $number;

    /**
    * @var float
    * @ORM\Column(name="balance", type="float")
    */
    private $balance;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity="Customer", inversedBy="account")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $owner;

    /**
    * @ORM\OneToMany(targetEntity="DebitCard", mappedBy="account", cascade={"persist", "remove"}, orphanRemoval=true)
    **/
    private $debitcard;

    public function __toString()
    {
        return $this->number.' - '.$this->type.'';
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
     * Set number
     *
     * @param string $number
     * @return Account
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Account
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\Customer $owner
     * @return Account
     */
    public function setOwner(\AppBundle\Entity\Customer $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\Customer 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->debitcard = new \Doctrine\Common\Collections\ArrayCollection();
        $this->balance = 0;
    }

    /**
     * Add debitcard
     *
     * @param \AppBundle\Entity\DebitCard $debitcard
     * @return Account
     */
    public function addDebitcard(\AppBundle\Entity\DebitCard $debitcard)
    {
        $this->debitcard[] = $debitcard;

        return $this;
    }

    /**
     * Remove debitcard
     *
     * @param \AppBundle\Entity\DebitCard $debitcard
     */
    public function removeDebitcard(\AppBundle\Entity\DebitCard $debitcard)
    {
        $this->debitcard->removeElement($debitcard);
    }

    /**
     * Get debitcard
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDebitcard()
    {
        return $this->debitcard;
    }

    /**
     * Set balance
     *
     * @param float $balance
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return float 
     */
    public function getBalance()
    {
        return $this->balance;
    }
}
