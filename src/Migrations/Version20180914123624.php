<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180914123624 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mairie ADD tampon_file_name VARCHAR(255) DEFAULT NULL, ADD cerfa_file_name VARCHAR(255) DEFAULT NULL, ADD logo_file_name VARCHAR(255) DEFAULT NULL, ADD photo1file_name VARCHAR(255) DEFAULT NULL, ADD photo2file_name VARCHAR(255) DEFAULT NULL, ADD last_upload DATETIME DEFAULT NULL, CHANGE image signature_file_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE hebergement CHANGE heb_etoiles heb_etoiles VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD photo1file VARCHAR(255) DEFAULT NULL, ADD photo2file VARCHAR(255) DEFAULT NULL, ADD photo3file VARCHAR(255) DEFAULT NULL, ADD photo4file VARCHAR(255) DEFAULT NULL, ADD last_upload DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement CHANGE heb_etoiles heb_etoiles TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE mairie ADD image VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, DROP signature_file_name, DROP tampon_file_name, DROP cerfa_file_name, DROP logo_file_name, DROP photo1file_name, DROP photo2file_name, DROP last_upload');
        $this->addSql('ALTER TABLE user DROP photo1file, DROP photo2file, DROP photo3file, DROP photo4file, DROP last_upload');
    }
}
