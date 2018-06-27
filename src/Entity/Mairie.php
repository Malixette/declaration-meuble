<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Mairie
 *
 * @ORM\Table(name="mairie", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_3946A254A73F0036", columns={"ville_id"})}, indexes={@ORM\Index(name="IDX_3946A254CF94313", columns={"office_tourisme_id"})})
 * @ORM\Entity
 */
class Mairie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_nom_touristique", type="string", length=255, nullable=true)
     */
    private $mairieNomTouristique;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_descriptif_1", type="string", length=255, nullable=true)
     */
    private $mairieDescriptif1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_descriptif_2", type="string", length=255, nullable=true)
     */
    private $mairieDescriptif2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_epci_rattachement", type="string", length=255, nullable=true)
     */
    private $mairieEpciRattachement;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_maire_nom", type="string", length=255, nullable=false)
     */
    private $mairieMaireNom;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_maire_prenom", type="string", length=255, nullable=false)
     */
    private $mairieMairePrenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_adjoint_nom", type="string", length=255, nullable=true)
     */
    private $mairieAdjointNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_adjoint_prenom", type="string", length=255, nullable=true)
     */
    private $mairieAdjointPrenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_contact_nom", type="string", length=255, nullable=true)
     */
    private $mairieContactNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_contact_prenom", type="string", length=255, nullable=true)
     */
    private $mairieContactPrenom;

    /**
     * @var int
     *
     * @ORM\Column(name="mairie_telephone_contact", type="string", nullable=false)
     */
    private $mairieTelephoneContact;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_email_contact", type="string", length=255, nullable=false)
     */
    private $mairieEmailContact;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_latitude", type="string", length=255, nullable=false)
     */
    private $mairieLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_longitude", type="string", length=255, nullable=false)
     */
    private $mairieLongitude;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_photo_1", type="string", length=255, nullable=true)
     */
    private $mairiePhoto1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_photo_2", type="string", length=255, nullable=true)
     */
    private $mairiePhoto2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_photo_3", type="string", length=255, nullable=true)
     */
    private $mairiePhoto3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_photo_4", type="string", length=255, nullable=true)
     */
    private $mairiePhoto4;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_taxe_sejour_gestionnaire", type="string", length=255, nullable=true)
     */
    private $mairieTaxeSejourGestionnaire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_taxe_sejour_bareme", type="string", length=255, nullable=true)
     */
    private $mairieTaxeSejourBareme;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_sejour_lien", type="string", length=255, nullable=true)
     */
    private $mairieSejourLien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_contact_nom_prenom", type="string", length=255, nullable=true)
     */
    private $mairieContactNomPrenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_de_telephone", type="text", length=255, nullable=true)
     */
    private $mairieDeTelephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_sejour_email", type="string", length=255, nullable=true)
     */
    private $mairieSejourEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_rappel_texte", type="string", length=255, nullable=true)
     */
    private $mairieRappelTexte;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_rappel_lien", type="string", length=255, nullable=true)
     */
    private $mairieRappelLien;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_logo", type="string", length=255, nullable=true)
     */
    private $mairieLogo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_logo_2", type="string", length=255, nullable=true)
     */
    private $mairieLogo2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="mairie_date_inscription", type="datetime", nullable=false)
     */
    private $mairieDateInscription;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_tampon", type="string", length=255, nullable=true)
     */
    private $mairieTampon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_maire_signature", type="string", length=255, nullable=true)
     */
    private $mairieMaireSignature;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_slug", type="string", length=255, nullable=false)
     */
    private $mairieSlug;

    /**
     * @var string
     *
     * @ORM\Column(name="insee", type="string", length=255, nullable=false)
     */
    private $insee;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_adresse", type="string", length=255, nullable=false)
     */
    private $mairieAdresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mairie_complement_adresse", type="string", length=255, nullable=true)
     */
    private $mairieComplementAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_postal_code", type="string", length=10, nullable=false)
     */
    private $mairiePostalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="mairie_commune", type="string", length=255, nullable=false)
     */
    private $mairieCommune;

    /**
     * @var \Villes
     *
     * @ORM\ManyToOne(targetEntity="Villes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     * })
     */
    private $ville;

    /**
     * @var \OfficeTourisme
     *
     * @ORM\ManyToOne(targetEntity="OfficeTourisme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="office_tourisme_id", referencedColumnName="id")
     * })
     */
    private $officeTourisme;

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
        return $this->mairieNomTouristique;
    }
    public function setMairieNomTouristique(?string $mairieNomTouristique): self
    {
        $this->mairieNomTouristique = $mairieNomTouristique;
        return $this;
    }
    public function getMairieDescriptif1(): ?string
    {
        return $this->mairieDescriptif1;
    }
    public function setMairieDescriptif1(?string $mairieDescriptif1): self
    {
        $this->mairieDescriptif1 = $mairieDescriptif1;
        return $this;
    }
    public function getMairieDescriptif2(): ?string
    {
        return $this->mairieDescriptif2;
    }
    public function setMairieDescriptif2(?string $mairieDescriptif2): self
    {
        $this->mairieDescriptif2 = $mairieDescriptif2;
        return $this;
    }
    public function getMairieEpciRattachement(): ?string
    {
        return $this->mairieEpciRattachement;
    }
    public function setMairieEpciRattachement(?string $mairieEpciRattachement): self
    {
        $this->mairieEpciRattachement = $mairieEpciRattachement;
        return $this;
    }
    public function getMairieMaireNom(): ?string
    {
        return $this->mairieMaireNom;
    }
    public function setMairieMaireNom(string $mairieMaireNom): self
    {
        $this->mairieMaireNom = $mairieMaireNom;
        return $this;
    }
    public function getMairieMairePrenom(): ?string
    {
        return $this->mairieMairePrenom;
    }
    public function setMairieMairePrenom(string $mairieMairePrenom): self
    {
        $this->mairieMairePrenom = $mairieMairePrenom;
        return $this;
    }
    public function getMairieAdjointNom(): ?string
    {
        return $this->mairieAdjointNom;
    }
    public function setMairieAdjointNom(?string $mairieAdjointNom): self
    {
        $this->mairieAdjointNom = $mairieAdjointNom;
        return $this;
    }
    public function getMairieAdjointPrenom(): ?string
    {
        return $this->mairieAdjointPrenom;
    }
    public function setMairieAdjointPrenom(?string $mairieAdjointPrenom): self
    {
        $this->mairieAdjointPrenom = $mairieAdjointPrenom;
        return $this;
    }
    public function getMairieContactNom(): ?string
    {
        return $this->mairieContactNom;
    }
    public function setMairieContactNom(?string $mairieContactNom): self
    {
        $this->mairieContactNom = $mairieContactNom;
        return $this;
    }
    public function getMairieContactPrenom(): ?string
    {
        return $this->mairieContactPrenom;
    }
    public function setMairieContactPrenom(?string $mairieContactPrenom): self
    {
        $this->mairieContactPrenom = $mairieContactPrenom;
        return $this;
    }
    public function getMairieTelephoneContact(): ?string
    {
        return $this->mairieTelephoneContact;
    }
    public function setMairieTelephoneContact(string $mairieTelephoneContact): self
    {
        $this->mairieTelephoneContact = $mairieTelephoneContact;
        return $this;
    }
    public function getMairieEmailContact(): ?string
    {
        return $this->mairieEmailContact;
    }
    public function setMairieEmailContact(string $mairieEmailContact): self
    {
        $this->mairieEmailContact = $mairieEmailContact;
        return $this;
    }
    public function getMairieLatitude(): ?float
    {
        return $this->mairieLatitude;
    }
    public function setMairieLatitude(float $mairieLatitude): self
    {
        $this->mairieLatitude = $mairieLatitude;
        return $this;
    }
    public function getMairieLongitude(): ?string
    {
        return $this->mairieLongitude;
    }
    public function setMairieLongitude(string $mairieLongitude): self
    {
        $this->mairieLongitude = $mairieLongitude;
        return $this;
    }
    public function getMairiePhoto1()
    {
        return $this->mairiePhoto1;
    }
    public function setMairiePhoto1($mairiePhoto1): self
    {
        $this->mairiePhoto1 = $mairiePhoto1;
        return $this;
    }
    public function getMairiePhoto2()
    {
        return $this->mairiePhoto2;
    }
    public function setMairiePhoto2($mairiePhoto2): self
    {
        $this->mairiePhoto2 = $mairiePhoto2;
        return $this;
    }
    public function getMairiePhoto3()
    {
        return $this->mairiePhoto3;
    }
    public function setMairiePhoto3($mairiePhoto3): self
    {
        $this->mairiePhoto3 = $mairiePhoto3;
        return $this;
    }
    public function getMairiePhoto4()
    {
        return $this->mairiePhoto4;
    }
    public function setMairiePhoto4($mairiePhoto4): self
    {
        $this->mairiePhoto4 = $mairiePhoto4;
        return $this;
    }
    public function getMairieTaxeSejourGestionnaire(): ?string
    {
        return $this->mairieTaxeSejourGestionnaire;
    }
    public function setMairieTaxeSejourGestionnaire(?string $mairieTaxeSejourGestionnaire): self
    {
        $this->mairieTaxeSejourGestionnaire = $mairieTaxeSejourGestionnaire;
        return $this;
    }
    public function getMairieTaxeSejourBareme(): ?string
    {
        return $this->mairieTaxeSejourBareme;
    }
    public function setMairieTaxeSejourBareme(?string $mairieTaxeSejourBareme): self
    {
        $this->mairieTaxeSejourBareme = $mairieTaxeSejourBareme;
        return $this;
    }
    public function getMairieSejourLien(): ?string
    {
        return $this->mairieSejourLien;
    }
    public function setMairieSejourLien(?string $mairieSejourLien): self
    {
        $this->mairieSejourLien = $mairieSejourLien;
        return $this;
    }
    public function getMairieContactNomPrenom(): ?string
    {
        return $this->mairieContactNomPrenom;
    }
    public function setMairieContactNomPrenom(?string $mairieContactNomPrenom): self
    {
        $this->mairieContactNomPrenom = $mairieContactNomPrenom;
        return $this;
    }
    public function getMairieDeTelephone(): ?string
    {
        return $this->mairieDeTelephone;
    }
    public function setMairieDeTelephone(?string $mairieDeTelephone): self
    {
        $this->mairieDeTelephone = $mairieDeTelephone;
        return $this;
    }
    public function getMairieSejourEmail(): ?string
    {
        return $this->mairieSejourEmail;
    }
    public function setMairieSejourEmail(?string $mairieSejourEmail): self
    {
        $this->mairieSejourEmail = $mairieSejourEmail;
        return $this;
    }
    public function getMairieRappelTexte(): ?string
    {
        return $this->mairieRappelTexte;
    }
    public function setMairieRappelTexte(?string $mairieRappelTexte): self
    {
        $this->mairieRappelTexte = $mairieRappelTexte;
        return $this;
    }
    public function getMairieRappelLien(): ?string
    {
        return $this->mairieRappelLien;
    }
    public function setMairieRappelLien(?string $mairieRappelLien): self
    {
        $this->mairieRappelLien = $mairieRappelLien;
        return $this;
    }
    public function getMairieLogo()
    {
        return $this->mairieLogo;
    }
    public function setMairieLogo($mairieLogo): self
    {
        $this->mairieLogo = $mairieLogo;
        return $this;
    }
    public function getMairieLogo2()
    {
        return $this->mairieLogo2;
    }
    public function setMairieLogo2($mairieLogo2): self
    {
        $this->mairieLogo2 = $mairieLogo2;
        return $this;
    }
    public function getMairieDateInscription(): ?\DateTimeInterface
    {
        return $this->mairieDateInscription;
    }
    public function setMairieDateInscription(\DateTimeInterface $mairieDateInscription): self
    {
        $this->mairieDateInscription = $mairieDateInscription;
        return $this;
    }
    public function getMairieTampon()
    {
        return $this->mairieTampon;
    }
    public function setMairieTampon($mairieTampon): self
    {
        $this->mairieTampon = $mairieTampon;
        return $this;
    }
    public function getMairieMaireSignature()
    {
        return $this->mairieMaireSignature;
    }
    public function setMairieMaireSignature($mairieMaireSignature): self
    {
        $this->mairieMaireSignature = $mairieMaireSignature;
        return $this;
    }
    public function getMairieSlug(): ?string
    {
        return $this->mairieSlug;
    }
    public function setMairieSlug(string $mairieSlug): self
    {
        $this->mairieSlug = $mairieSlug;
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
    public function getVilles(): ?Villes
    {
        return $this->ville;
    }
    public function setVilles(?Villes $villes): self
    {
        $this->ville = $villes;
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
    public function getInsee(): ?string
    {
        return $this->insee;
    }
    public function setInsee(string $insee): self
    {
        $this->insee = $insee;
        return $this;
    }
    public function getMairieAdresse(): ?string
    {
        return $this->mairieAdresse;
    }
    public function setMairieAdresse(string $mairieAdresse): self
    {
        $this->mairieAdresse = $mairieAdresse;
        return $this;
    }
    public function getMairieComplementAdresse(): ?string
    {
        return $this->mairieComplementAdresse;
    }
    public function setMairieComplementAdresse(?string $mairieComplementAdresse): self
    {
        $this->mairieComplementAdresse = $mairieComplementAdresse;
        return $this;
    }
    public function getMairiePostalCode(): ?string
    {
        return $this->mairiePostalCode;
    }
    public function setMairiePostalCode(string $mairiePostalCode): self
    {
        $this->mairiePostalCode = $mairiePostalCode;
        return $this;
    }
    public function getMairieCommune(): ?string
    {
        return $this->mairieCommune;
    }
    public function setMairieCommune(string $mairieCommune): self
    {
        $this->mairieCommune = $mairieCommune;
        return $this;
    }

}
