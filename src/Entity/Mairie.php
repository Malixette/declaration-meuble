<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MairieRepository")
 */
class Mairie
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
    private $mairie_nom_touristique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_descriptif_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_descriptif_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_epci_rattachement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mairie_maire_nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mairie_maire_prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_adjoint_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_adjoint_prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_contact_nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_contact_prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $mairie_telephone_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mairie_email_contact;

    /**
     * @ORM\Column(type="float")
     */
    private $mairie_latitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mairie_longitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_photo_1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_photo_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_photo_3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_photo_4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_taxe_sejour_gestionnaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_taxe_sejour_bareme;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_sejour_lien;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_contact_nom_prenom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mairie_de_telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_sejour_email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_rappel_texte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_rappel_lien;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_logo_2;

    /**
     * @ORM\Column(type="datetime")
     */
    private $mairie_date_inscription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_tampon;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mairie_maire_signature;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mairie_slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hebergement", mappedBy="mairie")
     */
    private $hebergements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="mairie")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Ville", inversedBy="mairie", cascade={"persist", "remove"})
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OfficeTourisme", inversedBy="mairies")
     */
    private $officeTourisme;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hebergement", mappedBy="coucou")
     */
    private $hebergement;

    public function __construct()
    {
        $this->user_id_heb = new ArrayCollection();
        $this->hebergements = new ArrayCollection();
        $this->mairie_id_user = new ArrayCollection();
        $this->user = new ArrayCollection();
        $this->hebergement = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMairieNomTouristique(): ?string
    {
        return $this->mairie_nom_touristique;
    }

    public function setMairieNomTouristique(?string $mairie_nom_touristique): self
    {
        $this->mairie_nom_touristique = $mairie_nom_touristique;

        return $this;
    }

    public function getMairieDescriptif1(): ?string
    {
        return $this->mairie_descriptif_1;
    }

    public function setMairieDescriptif1(?string $mairie_descriptif_1): self
    {
        $this->mairie_descriptif_1 = $mairie_descriptif_1;

        return $this;
    }

    public function getMairieDescriptif2(): ?string
    {
        return $this->mairie_descriptif_2;
    }

    public function setMairieDescriptif2(?string $mairie_descriptif_2): self
    {
        $this->mairie_descriptif_2 = $mairie_descriptif_2;

        return $this;
    }

    public function getMairieEpciRattachement(): ?string
    {
        return $this->mairie_epci_rattachement;
    }

    public function setMairieEpciRattachement(?string $mairie_epci_rattachement): self
    {
        $this->mairie_epci_rattachement = $mairie_epci_rattachement;

        return $this;
    }

    public function getMairieMaireNom(): ?string
    {
        return $this->mairie_maire_nom;
    }

    public function setMairieMaireNom(string $mairie_maire_nom): self
    {
        $this->mairie_maire_nom = $mairie_maire_nom;

        return $this;
    }

    public function getMairieMairePrenom(): ?string
    {
        return $this->mairie_maire_prenom;
    }

    public function setMairieMairePrenom(string $mairie_maire_prenom): self
    {
        $this->mairie_maire_prenom = $mairie_maire_prenom;

        return $this;
    }

    public function getMairieAdjointNom(): ?string
    {
        return $this->mairie_adjoint_nom;
    }

    public function setMairieAdjointNom(?string $mairie_adjoint_nom): self
    {
        $this->mairie_adjoint_nom = $mairie_adjoint_nom;

        return $this;
    }

    public function getMairieAdjointPrenom(): ?string
    {
        return $this->mairie_adjoint_prenom;
    }

    public function setMairieAdjointPrenom(?string $mairie_adjoint_prenom): self
    {
        $this->mairie_adjoint_prenom = $mairie_adjoint_prenom;

        return $this;
    }

    public function getMairieContactNom(): ?string
    {
        return $this->mairie_contact_nom;
    }

    public function setMairieContactNom(?string $mairie_contact_nom): self
    {
        $this->mairie_contact_nom = $mairie_contact_nom;

        return $this;
    }

    public function getMairieContactPrenom(): ?string
    {
        return $this->mairie_contact_prenom;
    }

    public function setMairieContactPrenom(?string $mairie_contact_prenom): self
    {
        $this->mairie_contact_prenom = $mairie_contact_prenom;

        return $this;
    }

    public function getMairieTelephoneContact(): ?int
    {
        return $this->mairie_telephone_contact;
    }

    public function setMairieTelephoneContact(int $mairie_telephone_contact): self
    {
        $this->mairie_telephone_contact = $mairie_telephone_contact;

        return $this;
    }

    public function getMairieEmailContact(): ?string
    {
        return $this->mairie_email_contact;
    }

    public function setMairieEmailContact(string $mairie_email_contact): self
    {
        $this->mairie_email_contact = $mairie_email_contact;

        return $this;
    }

    public function getMairieLatitude(): ?float
    {
        return $this->mairie_latitude;
    }

    public function setMairieLatitude(float $mairie_latitude): self
    {
        $this->mairie_latitude = $mairie_latitude;

        return $this;
    }

    public function getMairieLongitude(): ?string
    {
        return $this->mairie_longitude;
    }

    public function setMairieLongitude(string $mairie_longitude): self
    {
        $this->mairie_longitude = $mairie_longitude;

        return $this;
    }

    public function getMairiePhoto1(): ?string
    {
        return $this->mairie_photo_1;
    }

    public function setMairiePhoto1(?string $mairie_photo_1): self
    {
        $this->mairie_photo_1 = $mairie_photo_1;

        return $this;
    }

    public function getMairiePhoto2(): ?string
    {
        return $this->mairie_photo_2;
    }

    public function setMairiePhoto2(?string $mairie_photo_2): self
    {
        $this->mairie_photo_2 = $mairie_photo_2;

        return $this;
    }

    public function getMairiePhoto3(): ?string
    {
        return $this->mairie_photo_3;
    }

    public function setMairiePhoto3(?string $mairie_photo_3): self
    {
        $this->mairie_photo_3 = $mairie_photo_3;

        return $this;
    }

    public function getMairiePhoto4(): ?string
    {
        return $this->mairie_photo_4;
    }

    public function setMairiePhoto4(?string $mairie_photo_4): self
    {
        $this->mairie_photo_4 = $mairie_photo_4;

        return $this;
    }

    public function getMairieTaxeSejourGestionnaire(): ?string
    {
        return $this->mairie_taxe_sejour_gestionnaire;
    }

    public function setMairieTaxeSejourGestionnaire(?string $mairie_taxe_sejour_gestionnaire): self
    {
        $this->mairie_taxe_sejour_gestionnaire = $mairie_taxe_sejour_gestionnaire;

        return $this;
    }

    public function getMairieTaxeSejourBareme(): ?string
    {
        return $this->mairie_taxe_sejour_bareme;
    }

    public function setMairieTaxeSejourBareme(?string $mairie_taxe_sejour_bareme): self
    {
        $this->mairie_taxe_sejour_bareme = $mairie_taxe_sejour_bareme;

        return $this;
    }

    public function getMairieSejourLien(): ?string
    {
        return $this->mairie_sejour_lien;
    }

    public function setMairieSejourLien(?string $mairie_sejour_lien): self
    {
        $this->mairie_sejour_lien = $mairie_sejour_lien;

        return $this;
    }

    public function getMairieContactNomPrenom(): ?string
    {
        return $this->mairie_contact_nom_prenom;
    }

    public function setMairieContactNomPrenom(?string $mairie_contact_nom_prenom): self
    {
        $this->mairie_contact_nom_prenom = $mairie_contact_nom_prenom;

        return $this;
    }

    public function getMairieDeTelephone(): ?int
    {
        return $this->mairie_de_telephone;
    }

    public function setMairieDeTelephone(?int $mairie_de_telephone): self
    {
        $this->mairie_de_telephone = $mairie_de_telephone;

        return $this;
    }

    public function getMairieSejourEmail(): ?string
    {
        return $this->mairie_sejour_email;
    }

    public function setMairieSejourEmail(?string $mairie_sejour_email): self
    {
        $this->mairie_sejour_email = $mairie_sejour_email;

        return $this;
    }

    public function getMairieRappelTexte(): ?string
    {
        return $this->mairie_rappel_texte;
    }

    public function setMairieRappelTexte(?string $mairie_rappel_texte): self
    {
        $this->mairie_rappel_texte = $mairie_rappel_texte;

        return $this;
    }

    public function getMairieRappelLien(): ?string
    {
        return $this->mairie_rappel_lien;
    }

    public function setMairieRappelLien(?string $mairie_rappel_lien): self
    {
        $this->mairie_rappel_lien = $mairie_rappel_lien;

        return $this;
    }

    public function getMairieLogo(): ?string
    {
        return $this->mairie_logo;
    }

    public function setMairieLogo(?string $mairie_logo): self
    {
        $this->mairie_logo = $mairie_logo;

        return $this;
    }

    public function getComuneLogo2(): ?string
    {
        return $this->comune_logo_2;
    }

    public function setComuneLogo2(?string $comune_logo_2): self
    {
        $this->comune_logo_2 = $comune_logo_2;

        return $this;
    }

    public function getMairieDateInscription(): ?\DateTimeInterface
    {
        return $this->mairie_date_inscription;
    }

    public function setMairieDateInscription(\DateTimeInterface $mairie_date_inscription): self
    {
        $this->mairie_date_inscription = $mairie_date_inscription;

        return $this;
    }

    public function getMairieTampon(): ?string
    {
        return $this->mairie_tampon;
    }

    public function setMairieTampon(?string $mairie_tampon): self
    {
        $this->mairie_tampon = $mairie_tampon;

        return $this;
    }

    public function getMairieMaireSignature(): ?string
    {
        return $this->mairie_maire_signature;
    }

    public function setMairieMaireSignature(?string $mairie_maire_signature): self
    {
        $this->mairie_maire_signature = $mairie_maire_signature;

        return $this;
    }

    public function getMairieSlug(): ?string
    {
        return $this->mairie_slug;
    }

    public function setMairieSlug(string $mairie_slug): self
    {
        $this->mairie_slug = $mairie_slug;

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
            $hebergement->setMairie($this);
        }

        return $this;
    }

    public function removeHebergement(Hebergement $hebergement): self
    {
        if ($this->hebergements->contains($hebergement)) {
            $this->hebergements->removeElement($hebergement);
            // set the owning side to null (unless already changed)
            if ($hebergement->getMairie() === $this) {
                $hebergement->setMairie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setMairie($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getMairie() === $this) {
                $user->setMairie(null);
            }
        }

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getOfficeTourisme(): ?OfficeTourisme
    {
        return $this->officeTourisme;
    }

    public function setOfficeTourisme(?OfficeTourisme $officeTourisme): self
    {
        $this->officeTourisme = $officeTourisme;

        return $this;
    }

    /**
     * @return Collection|Hebergement[]
     */
    public function getHebergement(): Collection
    {
        return $this->hebergement;
    }
}