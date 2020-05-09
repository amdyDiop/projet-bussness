<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191206155533 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE client');
        $this->addSql('ALTER TABLE fos_user CHANGE numero_compte numero_compte VARCHAR(50)  NULL, CHANGE nom_boutique nom_boutique VARCHAR(50)  NULL, CHANGE description description VARCHAR(255)  NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, telephone VARCHAR(14) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(70) NOT NULL COLLATE utf8mb4_unicode_ci, prenom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, nom VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, addresse VARCHAR(70) NOT NULL COLLATE utf8mb4_unicode_ci, ville VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(90) NOT NULL COLLATE utf8mb4_unicode_ci, active TINYINT(1) DEFAULT NULL, INDEX IDX_C744045582EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE fos_user CHANGE numero_compte numero_compte VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_boutique nom_boutique VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
          }
}
