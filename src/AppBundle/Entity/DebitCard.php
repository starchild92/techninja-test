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
    * @ORM\OneToOne(targetEntity="Customer",)
    * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
    **/
    private $ownedby;

    /**
     * @ORM\ManyToOne(targetEntity="Bank", inversedBy="debitcards", cascade={"persist"})
     * @ORM\JoinColumn(name="bank_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $bank;

    /**
    * @ORM\ManyToOne(targetEntity="Account", inversedBy="debitcard", cascade={"persist"})
    * @ORM\JoinColumn(name="account_id", referencedColumnName="id", onDelete="CASCADE")
    **/
    private $account;

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
     * Set bank
     *
     * @param \AppBundle\Entity\Bank $bank
     * @return DebitCard
     */
    public function setBank(\AppBundle\Entity\Bank $bank = null)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return \AppBundle\Entity\Bank 
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set ownedby
     *
     * @param \AppBundle\Entity\Customer $ownedby
     * @return DebitCard
     */
    public function setOwnedby(\AppBundle\Entity\Customer $ownedby = null)
    {
        $this->ownedby = $ownedby;

        return $this;
    }

    /**
     * Get ownedby
     *
     * @return \AppBundle\Entity\Customer 
     */
    public function getOwnedby()
    {
        return $this->ownedby;
    }

    /**
     * Set account
     *
     * @param \AppBundle\Entity\Account $account
     * @return DebitCard
     */
    public function setAccount(\AppBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }
}
