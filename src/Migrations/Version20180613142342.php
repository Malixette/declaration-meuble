<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180613142342 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement ADD numero_appartement VARCHAR(255) DEFAULT NULL, ADD classement TINYINT(1) NOT NULL, ADD motif_supp VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD personne_morale VARCHAR(255) DEFAULT NULL, ADD siren_siret VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ville ADD un VARCHAR(255) NOT NULL, ADD deux VARCHAR(255) NOT NULL, DROP ville_departement, DROP ville_slug, DROP ville_nom, DROP ville_nom_simple, DROP ville_nom_reel, DROP ville_nom_soundex, DROP ville_nom_metaphone  1, DROP ville_code_postal, DROP ville_commune, DROP ville_ville, DROP ville_arrondissement, DROP ville_canton, DROP ville_amdi, DROP ville_population_2010, DROP ville_population_1999, DROP ville_population_2012approximatif, DROP ville_densite_2010, DROP ville_surface, DROP ville_longitude_deg, DROP ville_latitude_deg, DROP ville_longitude_grd, DROP ville_latitude_grd, DROP ville_longitude_dms, DROP ville_latitude_dms, DROP ville_zmin, DROP ville_zmax');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement DROP numero_appartement, DROP classement, DROP motif_supp');
        $this->addSql('ALTER TABLE user DROP personne_morale, DROP siren_siret');
        $this->addSql('ALTER TABLE ville ADD ville_departement VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_slug VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_nom_simple VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_nom_reel VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_nom_soundex VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_nom_metaphone  1 VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_code_postal INT NOT NULL, ADD ville_commune VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_ville VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_arrondissement INT DEFAULT NULL, ADD ville_canton VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_amdi VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, ADD ville_population_2010 INT NOT NULL, ADD ville_population_1999 INT NOT NULL, ADD ville_population_2012approximatif INT NOT NULL, ADD ville_densite_2010 INT NOT NULL, ADD ville_surface INT NOT NULL, ADD ville_longitude_deg DOUBLE PRECISION NOT NULL, ADD ville_latitude_deg DOUBLE PRECISION NOT NULL, ADD ville_longitude_grd DOUBLE PRECISION NOT NULL, ADD ville_latitude_grd DOUBLE PRECISION NOT NULL, ADD ville_longitude_dms DOUBLE PRECISION NOT NULL, ADD ville_latitude_dms DOUBLE PRECISION NOT NULL, ADD ville_zmin DOUBLE PRECISION NOT NULL, ADD ville_zmax DOUBLE PRECISION NOT NULL, DROP un, DROP deux');
    }
}
