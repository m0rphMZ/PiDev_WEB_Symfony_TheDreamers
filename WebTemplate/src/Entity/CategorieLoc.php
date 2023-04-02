<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategorieLoc
 *
 * @ORM\Table(name="categorie_loc")
 * @ORM\Entity
 */
class CategorieLoc
{
    /**
     * @var int
     *
     * @ORM\Column(name="codeC_loc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codecLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleC_loc", type="string", length=255, nullable=false)
     */
    private $libellecLoc;

    public function getCodecLoc(): ?int
    {
        return $this->codecLoc;
    }

    public function getLibellecLoc(): ?string
    {
        return $this->libellecLoc;
    }

    public function setLibellecLoc(string $libellecLoc): self
    {
        $this->libellecLoc = $libellecLoc;

        return $this;
    }


}
