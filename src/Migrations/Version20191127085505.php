<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127085505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE lcommande');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D55FB578A');
        $this->addSql('DROP INDEX IDX_6EEAA67D55FB578A ON commande');
        $this->addSql('ALTER TABLE commande DROP idlient_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lcommande (id INT AUTO_INCREMENT NOT NULL, id_produit_id INT NOT NULL, id_commande_id INT NOT NULL, quantite INT NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, tva INT NOT NULL, INDEX IDX_57961F0A9AF8E3A3 (id_commande_id), INDEX IDX_57961F0AAABEFE2C (id_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lcommande ADD CONSTRAINT FK_57961F0A9AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE lcommande ADD CONSTRAINT FK_57961F0AAABEFE2C FOREIGN KEY (id_produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE commande ADD idlient_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D55FB578A FOREIGN KEY (idlient_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D55FB578A ON commande (idlient_id)');

    }
}
