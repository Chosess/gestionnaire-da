<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231026085847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleves ADD moyen_paiement VARCHAR(255) DEFAULT NULL, ADD montant INT DEFAULT NULL, ADD dispositif_aide VARCHAR(255) DEFAULT NULL, DROP sport');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleves ADD sport TINYINT(1) DEFAULT NULL, DROP moyen_paiement, DROP montant, DROP dispositif_aide');
    }
}
