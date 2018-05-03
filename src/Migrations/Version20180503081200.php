<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180503081200 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement ADD heb_name VARCHAR(100) NOT NULL, ADD heb_num_declaration VARCHAR(255) NOT NULL, ADD heb_num_voie INT DEFAULT NULL, CHANGE heb_date_declaration heb_date_declaration DATETIME NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement DROP heb_name, DROP heb_num_declaration, DROP heb_num_voie, CHANGE heb_date_declaration heb_date_declaration VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
