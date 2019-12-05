<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203175016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user ADD commande_id INT DEFAULT NULL, ADD created_at DATETIME DEFAULT CURRENT_TIMESTAMP, ADD prenom VARCHAR(255) NOT NULL, ADD nom VARCHAR(50) NOT NULL, ADD addresse VARCHAR(70) NOT NULL, ADD ville VARCHAR(50) NOT NULL, ADD telephone VARCHAR(14) NOT NULL, ADD active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A647982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_957A647982EA2E54 ON fos_user (commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client ADD roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\', CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455E7927C74 ON client (email)');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A647982EA2E54');
        $this->addSql('DROP INDEX IDX_957A647982EA2E54 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP commande_id, DROP created_at, DROP prenom, DROP nom, DROP addresse, DROP ville, DROP telephone, DROP active');
         }
}
