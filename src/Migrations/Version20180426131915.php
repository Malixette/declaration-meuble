<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180426131915 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mairie (id INT AUTO_INCREMENT NOT NULL, mairie_ville_id INT DEFAULT NULL, mairie_ot_id INT DEFAULT NULL, mairie_nom_touristique VARCHAR(255) DEFAULT NULL, mairie_descriptif_1 VARCHAR(255) DEFAULT NULL, mairie_descriptif_2 VARCHAR(255) DEFAULT NULL, mairie_epci_rattachement VARCHAR(255) DEFAULT NULL, mairie_maire_nom VARCHAR(255) NOT NULL, mairie_maire_prenom VARCHAR(255) NOT NULL, mairie_adjoint_nom VARCHAR(255) DEFAULT NULL, mairie_adjoint_prenom VARCHAR(255) DEFAULT NULL, mairie_contact_nom VARCHAR(255) DEFAULT NULL, mairie_contact_prenom VARCHAR(255) DEFAULT NULL, mairie_telephone_contact INT NOT NULL, mairie_email_contact VARCHAR(255) NOT NULL, mairie_latitude DOUBLE PRECISION NOT NULL, mairie_longitude VARCHAR(255) NOT NULL, mairie_photo_1 VARCHAR(255) DEFAULT NULL, mairie_photo_2 VARCHAR(255) DEFAULT NULL, mairie_photo_3 VARCHAR(255) DEFAULT NULL, mairie_photo_4 VARCHAR(255) DEFAULT NULL, mairie_taxe_sejour_gestionnaire VARCHAR(255) DEFAULT NULL, mairie_taxe_sejour_bareme VARCHAR(255) DEFAULT NULL, mairie_sejour_lien VARCHAR(255) DEFAULT NULL, mairie_contact_nom_prenom VARCHAR(255) DEFAULT NULL, mairie_de_telephone INT DEFAULT NULL, mairie_sejour_email VARCHAR(255) DEFAULT NULL, mairie_rappel_texte VARCHAR(255) DEFAULT NULL, mairie_rappel_lien VARCHAR(255) DEFAULT NULL, mairie_logo VARCHAR(255) DEFAULT NULL, mairie_logo_2 VARCHAR(255) DEFAULT NULL, mairie_date_inscription DATETIME NOT NULL, mairie_tampon VARCHAR(255) DEFAULT NULL, mairie_maire_signature VARCHAR(255) DEFAULT NULL, mairie_slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_3946A2544A87A3FB (mairie_ville_id), INDEX IDX_3946A25422188F1D (mairie_ot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, mairie_id INT DEFAULT NULL, user_nom VARCHAR(255) NOT NULL, user_prenom VARCHAR(255) DEFAULT NULL, user_adresse VARCHAR(255) NOT NULL, user_complement_adresse VARCHAR(255) DEFAULT NULL, user_postal_code INT NOT NULL, user_commune VARCHAR(255) NOT NULL, user_pays VARCHAR(255) NOT NULL, user_telephone INT NOT NULL, user_email VARCHAR(255) NOT NULL, user_date_inscription DATETIME NOT NULL, user_role VARCHAR(255) NOT NULL, INDEX IDX_8D93D649E7A79AB (mairie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hebergement (id INT AUTO_INCREMENT NOT NULL, heb_user_id INT DEFAULT NULL, heb_mairie_id INT DEFAULT NULL, heb_ot_id INT DEFAULT NULL, heb_ville_id INT DEFAULT NULL, heb_adresse VARCHAR(255) NOT NULL, heb_adresse_complement VARCHAR(255) DEFAULT NULL, heb_batiment VARCHAR(255) DEFAULT NULL, heb_etage INT DEFAULT NULL, heb_code_postal INT NOT NULL, heb_commune VARCHAR(255) NOT NULL, heb_lat DOUBLE PRECISION NOT NULL, heb_long DOUBLE PRECISION NOT NULL, heb_type VARCHAR(255) NOT NULL, heb_nbr_pieces INT NOT NULL, heb_couchages_max INT NOT NULL, heb_classement VARCHAR(255) NOT NULL, heb_date_classement DATETIME DEFAULT NULL, heb_periodes_location VARCHAR(255) DEFAULT NULL, heb_date_declaration VARCHAR(255) NOT NULL, heb_numero_enregistrement INT NOT NULL, heb_descriptif_court VARCHAR(255) DEFAULT NULL, heb_photo_1 VARCHAR(255) DEFAULT NULL, heb_photo_2 VARCHAR(255) DEFAULT NULL, heb_photo_3 VARCHAR(255) DEFAULT NULL, heb_site_web VARCHAR(255) DEFAULT NULL, heb_site_resa VARCHAR(255) DEFAULT NULL, heb_contact_resa VARCHAR(255) DEFAULT NULL, heb_email_resa VARCHAR(255) DEFAULT NULL, heb_tel_resa INT DEFAULT NULL, heb_date_creation DATETIME NOT NULL, heb_statut VARCHAR(255) NOT NULL, heb_date_suppression DATETIME DEFAULT NULL, INDEX IDX_4852DD9C72CF4D06 (heb_user_id), INDEX IDX_4852DD9C43A1CB90 (heb_mairie_id), INDEX IDX_4852DD9C1E77B556 (heb_ot_id), INDEX IDX_4852DD9CCEEC6356 (heb_ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, ville_departement VARCHAR(255) NOT NULL, ville_slug VARCHAR(255) NOT NULL, ville_nom VARCHAR(255) NOT NULL, ville_nom_simple VARCHAR(255) NOT NULL, ville_nom_reel VARCHAR(255) NOT NULL, ville_nom_soundex VARCHAR(255) NOT NULL, ville_nom_metaphone  1 VARCHAR(255) NOT NULL, ville_code_postal INT NOT NULL, ville_commune VARCHAR(255) NOT NULL, ville_ville VARCHAR(255) NOT NULL, ville_arrondissement INT DEFAULT NULL, ville_canton VARCHAR(255) NOT NULL, ville_amdi VARCHAR(255) NOT NULL, ville_population_2010 INT NOT NULL, ville_population_1999 INT NOT NULL, ville_population_2012approximatif INT NOT NULL, ville_densite_2010 INT NOT NULL, ville_surface INT NOT NULL, ville_longitude_deg DOUBLE PRECISION NOT NULL, ville_latitude_deg DOUBLE PRECISION NOT NULL, ville_longitude_grd DOUBLE PRECISION NOT NULL, ville_latitude_grd DOUBLE PRECISION NOT NULL, ville_longitude_dms DOUBLE PRECISION NOT NULL, ville_latitude_dms DOUBLE PRECISION NOT NULL, ville_zmin DOUBLE PRECISION NOT NULL, ville_zmax DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE office_tourisme (id INT AUTO_INCREMENT NOT NULL, ot_referent_nom VARCHAR(255) DEFAULT NULL, ot_referent_prénom VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mairie ADD CONSTRAINT FK_3946A2544A87A3FB FOREIGN KEY (mairie_ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE mairie ADD CONSTRAINT FK_3946A25422188F1D FOREIGN KEY (mairie_ot_id) REFERENCES office_tourisme (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E7A79AB FOREIGN KEY (mairie_id) REFERENCES mairie (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C72CF4D06 FOREIGN KEY (heb_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C43A1CB90 FOREIGN KEY (heb_mairie_id) REFERENCES mairie (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C1E77B556 FOREIGN KEY (heb_ot_id) REFERENCES office_tourisme (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CCEEC6356 FOREIGN KEY (heb_ville_id) REFERENCES ville (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E7A79AB');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C43A1CB90');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C72CF4D06');
        $this->addSql('ALTER TABLE mairie DROP FOREIGN KEY FK_3946A2544A87A3FB');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CCEEC6356');
        $this->addSql('ALTER TABLE mairie DROP FOREIGN KEY FK_3946A25422188F1D');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C1E77B556');
        $this->addSql('DROP TABLE mairie');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE hebergement');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE office_tourisme');
    }
}
