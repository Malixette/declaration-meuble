<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_complement_adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_postal_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_commune;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_pays;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $user_date_inscription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hebergement", mappedBy="heb_id_user")
     */
    private $user_id_heb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hebergement", mappedBy="heb_id_user")
     */
    private $hebergements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mairie", inversedBy="mairie_user")
     */
    private $mairie;

    public function __construct()
    {
        $this->user_id_heb = new ArrayCollection();
        $this->hebergements = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserNom(): ?string
    {
        return $this->user_nom;
    }

    public function setUserNom(string $user_nom): self
    {
        $this->user_nom = $user_nom;

        return $this;
    }

    public function getUserPrenom(): ?string
    {
        return $this->user_prenom;
    }

    public function setUserPrenom(?string $user_prenom): self
    {
        $this->user_prenom = $user_prenom;

        return $this;
    }

    public function getUserAdresse(): ?string
    {
        return $this->user_adresse;
    }

    public function setUserAdresse(string $user_adresse): self
    {
        $this->user_adresse = $user_adresse;

        return $this;
    }

    public function getUserComplementAdresse(): ?string
    {
        return $this->user_complement_adresse;
    }

    public function setUserComplementAdresse(?string $user_complement_adresse): self
    {
        $this->user_complement_adresse = $user_complement_adresse;

        return $this;
    }

    public function getUserPostalCode(): ?int
    {
        return $this->user_postal_code;
    }

    public function setUserPostalCode(int $user_postal_code): self
    {
        $this->user_postal_code = $user_postal_code;

        return $this;
    }

    public function getUserCommune(): ?string
    {
        return $this->user_commune;
    }

    public function setUserCommune(string $user_commune): self
    {
        $this->user_commune = $user_commune;

        return $this;
    }

    public function getUserPays(): ?string
    {
        return $this->user_pays;
    }

    public function setUserPays(string $user_pays): self
    {
        $this->user_pays = $user_pays;

        return $this;
    }

    public function getUserTelephone(): ?int
    {
        return $this->user_telephone;
    }

    public function setUserTelephone(int $user_telephone): self
    {
        $this->user_telephone = $user_telephone;

        return $this;
    }

    public function getUserEmail(): ?string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): self
    {
        $this->user_email = $user_email;

        return $this;
    }

    public function getUserDateInscription(): ?\DateTimeInterface
    {
        return $this->user_date_inscription;
    }

    public function setUserDateInscription(\DateTimeInterface $user_date_inscription): self
    {
        $this->user_date_inscription = $user_date_inscription;

        return $this;
    }

    public function getUserRole(): ?string
    {
        return $this->user_role;
    }

    public function setUserRole(string $user_role): self
    {
        $this->user_role = $user_role;

        return $this;
    }

    /**
     * @return Collection|Hebergement[]
     */
    public function getUserIdHeb(): Collection
    {
        return $this->user_id_heb;
    }

    public function addUserIdHeb(Hebergement $userIdHeb): self
    {
        if (!$this->user_id_heb->contains($userIdHeb)) {
            $this->user_id_heb[] = $userIdHeb;
            $userIdHeb->setHebIdUser($this);
        }

        return $this;
    }

    public function removeUserIdHeb(Hebergement $userIdHeb): self
    {
        if ($this->user_id_heb->contains($userIdHeb)) {
            $this->user_id_heb->removeElement($userIdHeb);
            // set the owning side to null (unless already changed)
            if ($userIdHeb->getHebIdUser() === $this) {
                $userIdHeb->setHebIdUser(null);
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
            $hebergement->setHebIdUser($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): self
    {
        if ($this->hebergements->contains($hebergement)) {
            $this->hebergements->removeElement($hebergement);
            // set the owning side to null (unless already changed)
            if ($hebergement->getHebIdUser() === $this) {
                $hebergement->setHebIdUser(null);
            }
        }

        return $this;
    }

    public function getMairie(): ?Mairie
    {
        return $this->mairie;
    }

    public function setMairie(?Mairie $mairie): self
    {
        $this->mairie = $mairie;

        return $this;
    }
}
