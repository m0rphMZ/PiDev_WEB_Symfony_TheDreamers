<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reponses
 *
 * @ORM\Table(name="reponses", indexes={@ORM\Index(name="idx_user_id", columns={"user_id"}), @ORM\Index(name="idx_rec_id", columns={"rec_id"})})
 * @ORM\Entity
 */
class Reponses
{
    /**
     * @var int
     *
     * @ORM\Column(name="rep_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $repId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="admin_id", type="integer", nullable=true)
     */
    private $adminId;

    /**
     * @var string
     *
     * @ORM\Column(name="rep_description", type="text", length=0, nullable=false)
     */
    private $repDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rep", type="date", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateRep = 'CURRENT_TIMESTAMP';

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id_user")
     * })
     */
    private $user;

    /**
     * @var \Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rec_id", referencedColumnName="rec_id")
     * })
     */
    private $rec;

    public function getRepId(): ?int
    {
        return $this->repId;
    }

    public function getAdminId(): ?int
    {
        return $this->adminId;
    }

    public function setAdminId(?int $adminId): self
    {
        $this->adminId = $adminId;

        return $this;
    }

    public function getRepDescription(): ?string
    {
        return $this->repDescription;
    }

    public function setRepDescription(string $repDescription): self
    {
        $this->repDescription = $repDescription;

        return $this;
    }

    public function getDateRep(): ?\DateTimeInterface
    {
        return $this->dateRep;
    }

    public function setDateRep(\DateTimeInterface $dateRep): self
    {
        $this->dateRep = $dateRep;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRec(): ?Reclamation
    {
        return $this->rec;
    }

    public function setRec(?Reclamation $rec): self
    {
        $this->rec = $rec;

        return $this;
    }


}
