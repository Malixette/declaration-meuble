<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfficeTourismeRepository")
 */
class OfficeTourisme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ot_referent_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ot_referent_prénom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hebergement", mappedBy="officeTourisme")
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mairie", mappedBy="officeTourisme")
     */
    private $mairies;

    public function __construct()
    {
        $this->ot_id_hebergement = new ArrayCollection();
        $this->hebergements = new ArrayCollection();
        $this->mairies = new ArrayCollection();
        $this->ville = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOtReferentNom(): ?string
    {
        return $this->ot_referent_nom;
    }

    public function setOtReferentNom(?string $ot_referent_nom): self
    {
        $this->ot_referent_nom = $ot_referent_nom;

        return $this;
    }

    public function getOtReferentPrénom(): ?string
    {
        return $this->ot_referent_prénom;
    }

    public function setOtReferentPrénom(?string $ot_referent_prénom): self
    {
        $this->ot_referent_prénom = $ot_referent_prénom;

        return $this;
    }

    /**
     * @return Collection|Hebergement[]
     */
    public function getVille(): Collection
    {
        return $this->ville;
    }

    public function addVille(Hebergement $ville): self
    {
        if (!$this->ville->contains($ville)) {
            $this->ville[] = $ville;
            $ville->setOfficeTourisme($this);
        }

        return $this;
    }

    public function removeVille(Hebergement $ville): self
    {
        if ($this->ville->contains($ville)) {
            $this->ville->removeElement($ville);
            // set the owning side to null (unless already changed)
            if ($ville->getOfficeTourisme() === $this) {
                $ville->setOfficeTourisme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mairie[]
     */
    public function getMairies(): Collection
    {
        return $this->mairies;
    }

    public function addMairy(Mairie $mairy): self
    {
        if (!$this->mairies->contains($mairy)) {
            $this->mairies[] = $mairy;
            $mairy->setOfficeTourisme($this);
        }

        return $this;
    }

    public function removeMairy(Mairie $mairy): self
    {
        if ($this->mairies->contains($mairy)) {
            $this->mairies->removeElement($mairy);
            // set the owning side to null (unless already changed)
            if ($mairy->getOfficeTourisme() === $this) {
                $mairy->setOfficeTourisme(null);
            }
        }

        return $this;
    }

}
