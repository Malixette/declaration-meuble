<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180615124048 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C286C17BC FOREIGN KEY (villes_id) REFERENCES villes (ville_id)');
        $this->addSql('ALTER TABLE mairie ADD CONSTRAINT FK_3946A254A73F0036 FOREIGN KEY (ville_id) REFERENCES villes (ville_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C286C17BC');
        $this->addSql('ALTER TABLE mairie DROP FOREIGN KEY FK_3946A254A73F0036');
        $this->addSql('ALTER TABLE villes MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE villes DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE villes DROP id');
        $this->addSql('ALTER TABLE villes ADD PRIMARY KEY (ville_id)');
    }
}
