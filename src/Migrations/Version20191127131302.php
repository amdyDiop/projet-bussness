<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191127131302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boutique ADD file_name VARCHAR(255) NOT NULL, ADD prenom VARCHAR(60) NOT NULL, ADD email VARCHAR(60) NOT NULL, DROP prenom_vendeur, DROP mail_vendeur, CHANGE nombre_de_vente nombre_de_vente INT DEFAULT NULL, CHANGE nom_vendeur nom VARCHAR(70) NOT NULL');
        }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE boutique ADD prenom_vendeur VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, ADD mail_vendeur VARCHAR(60) NOT NULL COLLATE utf8mb4_unicode_ci, DROP file_name, DROP prenom, DROP email, CHANGE nombre_de_vente nombre_de_vente INT DEFAULT 0, CHANGE nom nom_vendeur VARCHAR(70) NOT NULL COLLATE utf8mb4_unicode_ci');
        }
}
