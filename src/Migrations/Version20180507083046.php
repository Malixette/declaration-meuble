<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180507083046 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement CHANGE heb_periodes_location heb_periodes_location LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE heb_date_declaration heb_date_declaration DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, CHANGE user_role user_role INT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement CHANGE heb_date_declaration heb_date_declaration VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE heb_periodes_location heb_periodes_location VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user DROP username, CHANGE user_role user_role VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
