<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bank
 *
 * @ORM\Table(name="bank")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BankRepository")
 */
class Bank
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
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="DebitCard", mappedBy="bank", cascade={"persist", "remove"}, orphanRemoval=true)
     **/
    private $debitcards;

    public function __toString(){
        return $this->name.' ('.$this->code.')';
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
     * Set code
     *
     * @param string $code
     * @return Bank
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Bank
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->debitcards = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add debitcards
     *
     * @param \AppBundle\Entity\DebitCard $debitcards
     * @return Bank
     */
    public function addDebitcard(\AppBundle\Entity\DebitCard $debitcards)
    {
        $this->debitcards[] = $debitcards;

        return $this;
    }

    /**
     * Remove debitcards
     *
     * @param \AppBundle\Entity\DebitCard $debitcards
     */
    public function removeDebitcard(\AppBundle\Entity\DebitCard $debitcards)
    {
        $this->debitcards->removeElement($debitcards);
    }

    /**
     * Get debitcards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDebitcards()
    {
        return $this->debitcards;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Bank
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
