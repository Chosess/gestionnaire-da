<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026092343 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleves ADD indicatif_cned VARCHAR(255) DEFAULT NULL, ADD stage_debut DATETIME DEFAULT NULL, ADD stage_fin DATETIME DEFAULT NULL, ADD stage_entreprise VARCHAR(255) DEFAULT NULL, ADD stage_tuteur VARCHAR(255) DEFAULT NULL, ADD stage_tuteur_fonction VARCHAR(255) DEFAULT NULL, ADD stage_tel VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleves DROP indicatif_cned, DROP stage_debut, DROP stage_fin, DROP stage_entreprise, DROP stage_tuteur, DROP stage_tuteur_fonction, DROP stage_tel');
    }
}
