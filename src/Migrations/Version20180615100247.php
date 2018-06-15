<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180615100247 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE villes_france_free');
        $this->addSql('ALTER TABLE villes MODIFY ville_id INT NOT NULL');
        $this->addSql('ALTER TABLE villes DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE villes ADD id INT AUTO_INCREMENT NOT NULL, CHANGE ville_id ville_id INT NOT NULL');
        $this->addSql('ALTER TABLE villes ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE villes_france_free (ville_id INT UNSIGNED AUTO_INCREMENT NOT NULL, ville_departement VARCHAR(3) DEFAULT NULL COLLATE utf8_general_ci, ville_slug VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ville_nom VARCHAR(45) DEFAULT NULL COLLATE utf8_general_ci, ville_nom_simple VARCHAR(45) DEFAULT NULL COLLATE utf8_general_ci, ville_nom_reel VARCHAR(45) DEFAULT NULL COLLATE utf8_general_ci, ville_nom_soundex VARCHAR(20) DEFAULT NULL COLLATE utf8_general_ci, ville_nom_metaphone VARCHAR(22) DEFAULT NULL COLLATE utf8_general_ci, ville_code_postal VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, ville_commune VARCHAR(3) DEFAULT NULL COLLATE utf8_general_ci, ville_code_commune VARCHAR(5) NOT NULL COLLATE utf8_general_ci, ville_arrondissement SMALLINT UNSIGNED DEFAULT NULL, ville_canton VARCHAR(4) DEFAULT NULL COLLATE utf8_general_ci, ville_amdi SMALLINT UNSIGNED DEFAULT NULL, ville_population_2010 INT UNSIGNED DEFAULT NULL, ville_population_1999 INT UNSIGNED DEFAULT NULL, ville_population_2012 INT UNSIGNED DEFAULT NULL COMMENT \'approximatif\', ville_densite_2010 INT DEFAULT NULL, ville_surface DOUBLE PRECISION DEFAULT NULL, ville_longitude_deg DOUBLE PRECISION DEFAULT NULL, ville_latitude_deg DOUBLE PRECISION DEFAULT NULL, ville_longitude_grd VARCHAR(9) DEFAULT NULL COLLATE utf8_general_ci, ville_latitude_grd VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci, ville_longitude_dms VARCHAR(9) DEFAULT NULL COLLATE utf8_general_ci, ville_latitude_dms VARCHAR(8) DEFAULT NULL COLLATE utf8_general_ci, ville_zmin INT DEFAULT NULL, ville_zmax INT DEFAULT NULL, UNIQUE INDEX ville_code_commune_2 (ville_code_commune), UNIQUE INDEX ville_slug (ville_slug), INDEX ville_departement (ville_departement), INDEX ville_nom (ville_nom), INDEX ville_nom_reel (ville_nom_reel), INDEX ville_code_commune (ville_code_commune), INDEX ville_code_postal (ville_code_postal), INDEX ville_longitude_latitude_deg (ville_longitude_deg, ville_latitude_deg), INDEX ville_nom_soundex (ville_nom_soundex), INDEX ville_nom_metaphone (ville_nom_metaphone), INDEX ville_population_2010 (ville_population_2010), INDEX ville_nom_simple (ville_nom_simple), PRIMARY KEY(ville_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE villes MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE villes DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE villes DROP id, CHANGE ville_id ville_id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE villes ADD PRIMARY KEY (ville_id)');
    }
}
