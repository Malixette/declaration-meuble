<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"user_email"},
 *     message="Cette adresse email est déjà enregistrée"
 * )
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=190,  unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     * min = 3,
     * max = 25,
     * minMessage = "Votre nom d'utilisateur est trop court.",
     * maxMessage = "Votre nom d'utilisateur est trop long."
     * )
     */
    private $username;

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
     * @ORM\Column(type="string", length=255)
     */
    private $user_postal_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user_commune;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_telephone;

    /**
     * @ORM\Column(type="string", length=123)
     * @ORM\Column(name="user_email", type="string", length=255, unique=true)
     * @Assert\Email(
     *   message = "The email '{{ value }}' is not a valid email.",
     *   checkMX = true
     * )
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
     * @ORM\OneToMany(targetEntity="App\Entity\Hebergement", mappedBy="user")
     */
    private $hebergements;
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $MairieToDeclarant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mairie", inversedBy="user")
     */
    private $mairie;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 8,
     * max = 255,
     * minMessage = "Le mot de passe choisi est trop court.",
     * maxMessage = "Le mot de passe choisi est trop long."
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_activated;

    public function __construct()
    {
        $this->user_id_heb = new ArrayCollection();
        $this->hebergements = new ArrayCollection();
        $this->MairieToDeclarant = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function getUserPostalCode(): ?string
    {
        return $this->user_postal_code;
    }

    public function setUserPostalCode(string $user_postal_code): self
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

    public function getUserTelephone(): ?string
    {
        return $this->user_telephone;
    }

    public function setUserTelephone(string $user_telephone): self
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
    public function getHebergements(): Collection
    {
        return $this->hebergements;
    }

    public function addHebergement(Hebergement $hebergement): self
    {
        if (!$this->hebergements->contains($hebergement)) {
            $this->hebergements[] = $hebergement;
            $hebergement->setUser($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): self
    {
        if ($this->hebergements->contains($hebergement)) {
            $this->hebergements->removeElement($hebergement);
            // set the owning side to null (unless already changed)
            if ($hebergement->getUser() === $this) {
                $hebergement->setUser(null);
            }
        }

        return $this;
    }
    
     /**
     * @return Collection|User[]
     */
    public function getMairieToDeclarant(): Collection
    {
        return $this->MairieToDeclarant;
    }

    public function addMairieToDeclarant(User $mairieToDeclarant): self
    {
        if (!$this->MairieToDeclarant->contains($mairieToDeclarant)) {
            $this->MairieToDeclarant[] = $mairieToDeclarant;
        }

        return $this;
    }

    public function removeMairieToDeclarant(User $mairieToDeclarant): self
    {
        if ($this->MairieToDeclarant->contains($mairieToDeclarant)) {
            $this->MairieToDeclarant->removeElement($mairieToDeclarant);
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles()
    {
        if ($this->user_role == 2)
            return ['ROLE_DECLARANT', 'ROLE_USER'];
        elseif ($this->user_role == 3)
            return ['ROLE_MAIRIE', 'ROLE_USER'];
        elseif ($this->user_role == 4)
            return ['ROLE_OT'];
        elseif ($this->user_role > 4)
            return ['ROLE_ADMIN'];
        else
            return [];
    }
    
    
    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }
    /** @see Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getIsActivated(): ?bool
    {
        return $this->is_activated;
    }

    public function setIsActivated(bool $is_activated): self
    {
        $this->is_activated = $is_activated;

        return $this;
    }    
}
