<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DebitCard
 *
 * @ORM\Table(name="debit_card")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DebitCardRepository")
 */
class DebitCard
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
     * @ORM\Column(name="cardno", type="string", length=255, unique=true)
     */
    private $cardno;

    /**
     * @var string
     *
     * @ORM\Column(name="ownedby", type="string", length=255)
     */
    private $ownedby;


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
     * Set cardno
     *
     * @param string $cardno
     * @return DebitCard
     */
    public function setCardno($cardno)
    {
        $this->cardno = $cardno;

        return $this;
    }

    /**
     * Get cardno
     *
     * @return string 
     */
    public function getCardno()
    {
        return $this->cardno;
    }

    /**
     * Set ownedby
     *
     * @param string $ownedby
     * @return DebitCard
     */
    public function setOwnedby($ownedby)
    {
        $this->ownedby = $ownedby;

        return $this;
    }

    /**
     * Get ownedby
     *
     * @return string 
     */
    public function getOwnedby()
    {
        return $this->ownedby;
    }
}
