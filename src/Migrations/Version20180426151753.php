<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180426151753 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CCEEC6356');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C1E77B556');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C43A1CB90');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9C72CF4D06');
        $this->addSql('DROP INDEX IDX_4852DD9C72CF4D06 ON hebergement');
        $this->addSql('DROP INDEX IDX_4852DD9C43A1CB90 ON hebergement');
        $this->addSql('DROP INDEX IDX_4852DD9C1E77B556 ON hebergement');
        $this->addSql('DROP INDEX IDX_4852DD9CCEEC6356 ON hebergement');
        $this->addSql('ALTER TABLE hebergement ADD user_id INT DEFAULT NULL, ADD mairie_id INT DEFAULT NULL, ADD office_tourisme_id INT DEFAULT NULL, ADD ville_id INT DEFAULT NULL, DROP heb_user_id, DROP heb_mairie_id, DROP heb_ot_id, DROP heb_ville_id');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CE7A79AB FOREIGN KEY (mairie_id) REFERENCES mairie (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CCF94313 FOREIGN KEY (office_tourisme_id) REFERENCES office_tourisme (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_4852DD9CA76ED395 ON hebergement (user_id)');
        $this->addSql('CREATE INDEX IDX_4852DD9CE7A79AB ON hebergement (mairie_id)');
        $this->addSql('CREATE INDEX IDX_4852DD9CCF94313 ON hebergement (office_tourisme_id)');
        $this->addSql('CREATE INDEX IDX_4852DD9CA73F0036 ON hebergement (ville_id)');
        $this->addSql('ALTER TABLE mairie DROP FOREIGN KEY FK_3946A25422188F1D');
        $this->addSql('ALTER TABLE mairie DROP FOREIGN KEY FK_3946A2544A87A3FB');
        $this->addSql('DROP INDEX UNIQ_3946A2544A87A3FB ON mairie');
        $this->addSql('DROP INDEX IDX_3946A25422188F1D ON mairie');
        $this->addSql('ALTER TABLE mairie ADD ville_id INT DEFAULT NULL, ADD office_tourisme_id INT DEFAULT NULL, DROP mairie_ville_id, DROP mairie_ot_id');
        $this->addSql('ALTER TABLE mairie ADD CONSTRAINT FK_3946A254A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE mairie ADD CONSTRAINT FK_3946A254CF94313 FOREIGN KEY (office_tourisme_id) REFERENCES office_tourisme (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3946A254A73F0036 ON mairie (ville_id)');
        $this->addSql('CREATE INDEX IDX_3946A254CF94313 ON mairie (office_tourisme_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CA76ED395');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CE7A79AB');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CCF94313');
        $this->addSql('ALTER TABLE hebergement DROP FOREIGN KEY FK_4852DD9CA73F0036');
        $this->addSql('DROP INDEX IDX_4852DD9CA76ED395 ON hebergement');
        $this->addSql('DROP INDEX IDX_4852DD9CE7A79AB ON hebergement');
        $this->addSql('DROP INDEX IDX_4852DD9CCF94313 ON hebergement');
        $this->addSql('DROP INDEX IDX_4852DD9CA73F0036 ON hebergement');
        $this->addSql('ALTER TABLE hebergement ADD heb_user_id INT DEFAULT NULL, ADD heb_mairie_id INT DEFAULT NULL, ADD heb_ot_id INT DEFAULT NULL, ADD heb_ville_id INT DEFAULT NULL, DROP user_id, DROP mairie_id, DROP office_tourisme_id, DROP ville_id');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9CCEEC6356 FOREIGN KEY (heb_ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C1E77B556 FOREIGN KEY (heb_ot_id) REFERENCES office_tourisme (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C43A1CB90 FOREIGN KEY (heb_mairie_id) REFERENCES mairie (id)');
        $this->addSql('ALTER TABLE hebergement ADD CONSTRAINT FK_4852DD9C72CF4D06 FOREIGN KEY (heb_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_4852DD9C72CF4D06 ON hebergement (heb_user_id)');
        $this->addSql('CREATE INDEX IDX_4852DD9C43A1CB90 ON hebergement (heb_mairie_id)');
        $this->addSql('CREATE INDEX IDX_4852DD9C1E77B556 ON hebergement (heb_ot_id)');
        $this->addSql('CREATE INDEX IDX_4852DD9CCEEC6356 ON hebergement (heb_ville_id)');
        $this->addSql('ALTER TABLE mairie DROP FOREIGN KEY FK_3946A254A73F0036');
        $this->addSql('ALTER TABLE mairie DROP FOREIGN KEY FK_3946A254CF94313');
        $this->addSql('DROP INDEX UNIQ_3946A254A73F0036 ON mairie');
        $this->addSql('DROP INDEX IDX_3946A254CF94313 ON mairie');
        $this->addSql('ALTER TABLE mairie ADD mairie_ville_id INT DEFAULT NULL, ADD mairie_ot_id INT DEFAULT NULL, DROP ville_id, DROP office_tourisme_id');
        $this->addSql('ALTER TABLE mairie ADD CONSTRAINT FK_3946A25422188F1D FOREIGN KEY (mairie_ot_id) REFERENCES office_tourisme (id)');
        $this->addSql('ALTER TABLE mairie ADD CONSTRAINT FK_3946A2544A87A3FB FOREIGN KEY (mairie_ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3946A2544A87A3FB ON mairie (mairie_ville_id)');
        $this->addSql('CREATE INDEX IDX_3946A25422188F1D ON mairie (mairie_ot_id)');
    }
}
