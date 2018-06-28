<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180627131542 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mairie ADD mairie_telephone_general VARCHAR(255) NOT NULL, CHANGE mairie_telephone_contact mairie_telephone_contact INT DEFAULT NULL, CHANGE mairie_email_contact mairie_email_contact VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mairie DROP mairie_telephone_general, CHANGE mairie_telephone_contact mairie_telephone_contact VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE mairie_email_contact mairie_email_contact VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
