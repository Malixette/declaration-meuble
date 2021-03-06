<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\HebergementRepository")
 */
class Hebergement
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
    private $heb_adresse;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heb_adresse_complement;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heb_batiment;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $heb_etage;
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $heb_code_postal;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heb_commune;
    /**
     * @ORM\Column(type="float")
     */
    private $heb_lat;
    /**
     * @ORM\Column(type="float")
     */
    private $heb_long;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heb_type;
    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min = 0)
     */
    private $heb_nbr_pieces;
    /**
     * @ORM\Column(type="integer")
     */
    private $heb_couchages_max;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heb_classement;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $heb_date_classement;
    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $heb_date_declaration;
    /**
     * @ORM\Column(type="integer")
     */
    private $heb_cerfa;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heb_descriptif_court;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *      maxSize = "1M",
     *      mimeTypes = {"image/jpeg", "image/png"},
     *      mimeTypesMessage = "Merci de télécharger un format valide: jpeg ou png."
     * )
     * 
     */
    private $heb_photo_1;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * * @Assert\File(
     *      maxSize = "1M",
     *      mimeTypes = {"image/jpeg", "image/png"},
     *      mimeTypesMessage = "Merci de télécharger un format valide: jpeg ou png."
     * )
     * 
     */
    private $heb_photo_2;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * * @Assert\File(
     *      maxSize = "1M",
     *      mimeTypes = {"image/jpeg", "image/png"},
     *      mimeTypesMessage = "Merci de télécharger un format valide: jpeg ou png."
     * )
     * 
     */
    private $heb_photo_3;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heb_site_web;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heb_site_resa;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heb_contact_resa;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heb_email_resa;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $heb_tel_resa;
    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $heb_date_creation;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heb_statut;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $heb_date_suppression;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="hebergements")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mairie", inversedBy="hebergements")
     */
    private $mairie;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OfficeTourisme", inversedBy="villes")
     */
    private $officeTourisme;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Villes", inversedBy="hebergements")
     */
    private $villes;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $heb_name;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heb_num_declaration;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $heb_num_voie;
    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $heb_periodes_location;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numero_appartement;
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $heb_etoiles;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motif_supp;
    
    public function getId()
    {
        return $this->id;
    }
    public function getHebAdresse(): ?string
    {
        return $this->heb_adresse;
    }
    public function setHebAdresse(string $heb_adresse): self
    {
        $this->heb_adresse = $heb_adresse;
        return $this;
    }
    public function getHebAdresseComplement(): ?string
    {
        return $this->heb_adresse_complement;
    }
    public function setHebAdresseComplement(?string $heb_adresse_complement): self
    {
        $this->heb_adresse_complement = $heb_adresse_complement;
        return $this;
    }
    public function getHebBatiment(): ?string
    {
        return $this->heb_batiment;
    }
    public function setHebBatiment(?string $heb_batiment): self
    {
        $this->heb_batiment = $heb_batiment;
        return $this;
    }
    public function getHebEtage(): ?int
    {
        return $this->heb_etage;
    }
    public function setHebEtage(?int $heb_etage): self
    {
        $this->heb_etage = $heb_etage;
        return $this;
    }
    public function getHebCodePostal(): ?string
    {
        return $this->heb_code_postal;
    }
    public function setHebCodePostal(string $heb_code_postal): self
    {
        $this->heb_code_postal = $heb_code_postal;
        return $this;
    }
    public function getHebCommune(): ?string
    {
        return $this->heb_commune;
    }
    public function setHebCommune(string $heb_commune): self
    {
        $this->heb_commune = $heb_commune;
        return $this;
    }
    public function getHebLat(): ?float
    {
        return $this->heb_lat;
    }
    public function setHebLat(float $heb_lat): self
    {
        $this->heb_lat = $heb_lat;
        return $this;
    }
    public function getHebLong(): ?float
    {
        return $this->heb_long;
    }
    public function setHebLong(float $heb_long): self
    {
        $this->heb_long = $heb_long;
        return $this;
    }
    public function getHebType(): ?string
    {
        return $this->heb_type;
    }
    public function setHebType(string $heb_type): self
    {
        $this->heb_type = $heb_type;
        return $this;
    }
    public function getHebNbrPieces(): ?int
    {
        return $this->heb_nbr_pieces;
    }
    public function setHebNbrPieces(int $heb_nbr_pieces): self
    {
        $this->heb_nbr_pieces = $heb_nbr_pieces;
        return $this;
    }
    public function getHebCouchagesMax(): ?int
    {
        return $this->heb_couchages_max;
    }
    public function setHebCouchagesMax(int $heb_couchages_max): self
    {
        $this->heb_couchages_max = $heb_couchages_max;
        return $this;
    }
    public function getHebClassement(): ?string
    {
        return $this->heb_classement;
    }
    public function setHebClassement(string $heb_classement): self
    {
        $this->heb_classement = $heb_classement;
        return $this;
    }
    public function getHebDateClassement(): ?\DateTimeInterface
    {
        return $this->heb_date_classement;
    }
    public function setHebDateClassement(?\DateTimeInterface $heb_date_classement): self
    {
        $this->heb_date_classement = $heb_date_classement;
        return $this;
    }
    public function getHebDateDeclaration(): ?\DateTimeInterface
    {
        return $this->heb_date_declaration;
    }
    public function setHebDateDeclaration($heb_date_declaration): self
    {
        $this->heb_date_declaration = $heb_date_declaration;
        return $this;
    }
    public function getHebCerfa(): ?int
    {
        return $this->heb_cerfa;
    }
    public function setHebCerfa($heb_cerfa): self
    {
        $this->heb_cerfa = $heb_cerfa;
        return $this;
    }
    public function getHebDescriptifCourt(): ?string
    {
        return $this->heb_descriptif_court;
    }
    public function setHebDescriptifCourt(?string $heb_descriptif_court): self
    {
        $this->heb_descriptif_court = $heb_descriptif_court;
        return $this;
    }
    public function getHebPhoto1()
    {
        return $this->heb_photo_1;
    }
    public function setHebPhoto1($heb_photo_1): self
    {
        $this->heb_photo_1 = $heb_photo_1;
        return $this;
    }
    public function getHebPhoto2()
    {
        return $this->heb_photo_2;
    }
    public function setHebPhoto2($heb_photo_2): self
    {
        $this->heb_photo_2 = $heb_photo_2;
        return $this;
    }
    public function getHebPhoto3()
    {
        return $this->heb_photo_3;
    }
    public function setHebPhoto3($heb_photo_3): self
    {
        $this->heb_photo_3 = $heb_photo_3;
        return $this;
    }
    public function getHebSiteWeb(): ?string
    {
        return $this->heb_site_web;
    }
    public function setHebSiteWeb(?string $heb_site_web): self
    {
        $this->heb_site_web = $heb_site_web;
        return $this;
    }
    public function getHebSiteResa(): ?string
    {
        return $this->heb_site_resa;
    }
    public function setHebSiteResa(?string $heb_site_resa): self
    {
        $this->heb_site_resa = $heb_site_resa;
        return $this;
    }
    public function getHebContactResa(): ?string
    {
        return $this->heb_contact_resa;
    }
    public function setHebContactResa(?string $heb_contact_resa): self
    {
        $this->heb_contact_resa = $heb_contact_resa;
        return $this;
    }
    public function getHebEmailResa(): ?string
    {
        return $this->heb_email_resa;
    }
    public function setHebEmailResa(?string $heb_email_resa): self
    {
        $this->heb_email_resa = $heb_email_resa;
        return $this;
    }
    public function getHebTelResa(): ?string
    {
        return $this->heb_tel_resa;
    }
    public function setHebTelResa(?string $heb_tel_resa): self
    {
        $this->heb_tel_resa = $heb_tel_resa;
        return $this;
    }
    public function getHebDateCreation(): ?\DateTimeInterface
    {
        return $this->heb_date_creation;
    }
    public function setHebDateCreation(\DateTimeInterface $heb_date_creation): self
    {
        $this->heb_date_creation = $heb_date_creation;
        return $this;
    }
    public function getHebStatut(): ?string
    {
        return $this->heb_statut;
    }
    public function setHebStatut(string $heb_statut): self
    {
        $this->heb_statut = $heb_statut;
        return $this;
    }
    public function getHebDateSuppression(): ?\DateTimeInterface
    {
        return $this->heb_date_suppression;
    }
    public function setHebDateSuppression(?\DateTimeInterface $heb_date_suppression): self
    {
        $this->heb_date_suppression = $heb_date_suppression;
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
    public function getMairie(): ?Mairie
    {
        return $this->mairie;
    }
    public function setMairie(?Mairie $mairie): self
    {
        $this->mairie = $mairie;
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
    public function getVilles(): ?Villes
    {
        return $this->villes;
    }
    public function setVilles(?Villes $villes): self
    {
        $this->villes = $villes;
        return $this;
    }
    public function getHebName(): ?string
    {
        return $this->heb_name;
    }
    public function setHebName(string $heb_name): self
    {
        $this->heb_name = $heb_name;
        return $this;
    }
    public function getHebNumDeclaration(): ?string
    {
        return $this->heb_num_declaration;
    }
    public function setHebNumDeclaration(string $heb_num_declaration): self
    {
        $this->heb_num_declaration = $heb_num_declaration;
        return $this;
    }
    public function getHebNumVoie(): ?int
    {
        return $this->heb_num_voie;
    }
    public function setHebNumVoie(?int $heb_num_voie): self
    {
        $this->heb_num_voie = $heb_num_voie;
        return $this;
    }
    public function getHebPeriodesLocation(): ?array
    {
        return $this->heb_periodes_location;
    }
    public function setHebPeriodesLocation(?array $heb_periodes_location): self
    {
        $this->heb_periodes_location = $heb_periodes_location;
        return $this;
    }
    public function getNumeroAppartement(): ?string
    {
        return $this->numero_appartement;
    }
    public function setNumeroAppartement(?string $numero_appartement): self
    {
        $this->numero_appartement = $numero_appartement;
        return $this;
    }
    public function getHebEtoiles(): ?string
    {
        return $this->heb_etoiles;
    }
    public function setHebEtoiles(?string $hebEtoiles): self
    {
        $this->heb_etoiles = $hebEtoiles;
        return $this;
    }
    public function getMotifSupp(): ?string
    {
        return $this->motif_supp;
    }
    public function setMotifSupp(?string $motif_supp): self
    {
        $this->motif_supp = $motif_supp;
        return $this;
    }
}