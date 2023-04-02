<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reponses
 *
 * @ORM\Table(name="reponses", indexes={@ORM\Index(name="idx_rec_id", columns={"rec_id"}), @ORM\Index(name="idx_user_id", columns={"user_id"})})
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
     * @var int
     *
     * @ORM\Column(name="rec_id", type="integer", nullable=false)
     */
    private $recId;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="admin_id", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $adminId = NULL;

    /**
     * @var string
     *
     * @ORM\Column(name="rep_description", type="text", length=0, nullable=false)
     */
    private $repDescription;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_rep", type="date", nullable=false, options={"default"="current_timestamp()"})
     */
    private $dateRep = 'current_timestamp()';

    public function getRepId(): ?int
    {
        return $this->repId;
    }

    public function getRecId(): ?int
    {
        return $this->recId;
    }

    public function setRecId(int $recId): self
    {
        $this->recId = $recId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
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


}
