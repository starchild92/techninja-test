<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transferences
 *
 * @ORM\Table(name="transferences")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransferencesRepository")
 */
class Transferences
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
    * @var float
    * @ORM\Column(name="amount", type="float")
    */
    private $amount;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", cascade={"persist"})
     * @ORM\JoinColumn(name="customer_origin_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", cascade={"persist"})
     * @ORM\JoinColumn(name="customer_destination_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $destination;


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
     * @return Transferences
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
     * Set amount
     *
     * @param float $amount
     * @return Transferences
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set origin
     *
     * @param \AppBundle\Entity\Customer $origin
     * @return Transferences
     */
    public function setOrigin(\AppBundle\Entity\Customer $origin = null)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return \AppBundle\Entity\Customer 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set destination
     *
     * @param \AppBundle\Entity\Customer $destination
     * @return Transferences
     */
    public function setDestination(\AppBundle\Entity\Customer $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \AppBundle\Entity\Customer 
     */
    public function getDestination()
    {
        return $this->destination;
    }
}
