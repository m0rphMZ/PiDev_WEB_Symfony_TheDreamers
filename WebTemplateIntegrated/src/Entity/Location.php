<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Location
 *
 * @ORM\Table(name="location", indexes={@ORM\Index(name="fk_codeC", columns={"code_catg"})})
 * @ORM\Entity
 */
class Location
{
    /**
     * @var int
     *
     * @ORM\Column(name="num_loc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="descipt_loc", type="string", length=255, nullable=false)
     */
    private $desciptLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_loc", type="string", length=255, nullable=false)
     */
    private $lieuLoc;

    /**
     * @var float
     *
     * @ORM\Column(name="surface_loc", type="float", precision=10, scale=0, nullable=false)
     */
    private $surfaceLoc;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_pers_loc", type="integer", nullable=false)
     */
    private $nbPersLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", length=0, nullable=false)
     */
    private $image;

    /**
     * @var \CategorieLoc
     *
     * @ORM\ManyToOne(targetEntity="CategorieLoc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code_catg", referencedColumnName="codeC_loc")
     * })
     */
    private $codeCatg;

    public function getNumLoc(): ?int
    {
        return $this->numLoc;
    }

    public function getDesciptLoc(): ?string
    {
        return $this->desciptLoc;
    }

    public function setDesciptLoc(string $desciptLoc): self
    {
        $this->desciptLoc = $desciptLoc;

        return $this;
    }

    public function getLieuLoc(): ?string
    {
        return $this->lieuLoc;
    }

    public function setLieuLoc(string $lieuLoc): self
    {
        $this->lieuLoc = $lieuLoc;

        return $this;
    }

    public function getSurfaceLoc(): ?float
    {
        return $this->surfaceLoc;
    }

    public function setSurfaceLoc(float $surfaceLoc): self
    {
        $this->surfaceLoc = $surfaceLoc;

        return $this;
    }

    public function getNbPersLoc(): ?int
    {
        return $this->nbPersLoc;
    }

    public function setNbPersLoc(int $nbPersLoc): self
    {
        $this->nbPersLoc = $nbPersLoc;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCodeCatg(): ?CategorieLoc
    {
        return $this->codeCatg;
    }

    public function setCodeCatg(?CategorieLoc $codeCatg): self
    {
        $this->codeCatg = $codeCatg;

        return $this;
    }


}
