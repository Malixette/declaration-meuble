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
     * @ORM\OneToMany(targetEntity="App\Entity\Hebergement", mappedBy="heb_id_ot")
     */
    private $hebergements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mairie", mappedBy="mairie_ot")
     */
    private $mairies;

    public function __construct()
    {
        $this->ot_id_hebergement = new ArrayCollection();
        $this->hebergements = new ArrayCollection();
        $this->mairies = new ArrayCollection();
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
    public function getOtIdHebergement(): Collection
    {
        return $this->ot_id_hebergement;
    }

    public function addOtIdHebergement(Hebergement $otIdHebergement): self
    {
        if (!$this->ot_id_hebergement->contains($otIdHebergement)) {
            $this->ot_id_hebergement[] = $otIdHebergement;
            $otIdHebergement->setHebIdOt($this);
        }

        return $this;
    }

    public function removeOtIdHebergement(Hebergement $otIdHebergement): self
    {
        if ($this->ot_id_hebergement->contains($otIdHebergement)) {
            $this->ot_id_hebergement->removeElement($otIdHebergement);
            // set the owning side to null (unless already changed)
            if ($otIdHebergement->getHebIdOt() === $this) {
                $otIdHebergement->setHebIdOt(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hebergement[]
     */
    public function getHebergements(): Collection
    {
        return $this->hebergements;
    }

    public function addHebergement(Hebergement $hebergement): self
    {
        if (!$this->hebergements->contains($hebergement)) {
            $this->hebergements[] = $hebergement;
            $hebergement->setHebIdOt($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): self
    {
        if ($this->hebergements->contains($hebergement)) {
            $this->hebergements->removeElement($hebergement);
            // set the owning side to null (unless already changed)
            if ($hebergement->getHebIdOt() === $this) {
                $hebergement->setHebIdOt(null);
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
            $mairy->setMairieOt($this);
        }

        return $this;
    }

    public function removeMairy(Mairie $mairy): self
    {
        if ($this->mairies->contains($mairy)) {
            $this->mairies->removeElement($mairy);
            // set the owning side to null (unless already changed)
            if ($mairy->getMairieOt() === $this) {
                $mairy->setMairieOt(null);
            }
        }

        return $this;
    }
}
