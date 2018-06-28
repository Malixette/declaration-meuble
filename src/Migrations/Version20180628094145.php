<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180628094145 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE villes DROP FOREIGN KEY FK_19209FD8FD412D22');
        $this->addSql('DROP INDEX UNIQ_19209FD8FD412D22 ON villes');
        $this->addSql('ALTER TABLE villes CHANGE mairie_id_id mairie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE villes ADD CONSTRAINT FK_19209FD8E7A79AB FOREIGN KEY (mairie_id) REFERENCES mairie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_19209FD8E7A79AB ON villes (mairie_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE villes DROP FOREIGN KEY FK_19209FD8E7A79AB');
        $this->addSql('DROP INDEX UNIQ_19209FD8E7A79AB ON villes');
        $this->addSql('ALTER TABLE villes CHANGE mairie_id mairie_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE villes ADD CONSTRAINT FK_19209FD8FD412D22 FOREIGN KEY (mairie_id_id) REFERENCES mairie (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_19209FD8FD412D22 ON villes (mairie_id_id)');
    }
}
