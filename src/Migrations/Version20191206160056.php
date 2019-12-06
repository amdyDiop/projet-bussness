<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206160056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user ADD commandes_id INT DEFAULT NULL ');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64798BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_957A64798BF5C2E6 ON fos_user (commandes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64798BF5C2E6');
        $this->addSql('DROP INDEX IDX_957A64798BF5C2E6 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP commandes_id, CHANGE numero_compte numero_compte VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_boutique nom_boutique VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        }
}
