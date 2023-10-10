<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920134247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE absences (id INT AUTO_INCREMENT NOT NULL, eleves_id INT NOT NULL, debut DATETIME NOT NULL, fin DATETIME NOT NULL, motif LONGTEXT NOT NULL, justif TINYINT(1) NOT NULL, document VARCHAR(255) NOT NULL, INDEX IDX_F9C0EFFFC2140342 (eleves_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documents (id INT AUTO_INCREMENT NOT NULL, eleves_id INT NOT NULL, document VARCHAR(255) NOT NULL, INDEX IDX_A2B07288C2140342 (eleves_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleves (id INT AUTO_INCREMENT NOT NULL, educateurs_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, civilite VARCHAR(255) NOT NULL, validation_inscription TINYINT(1) NOT NULL, date_inscription DATETIME NOT NULL, formation VARCHAR(255) NOT NULL, niveau_formation VARCHAR(255) NOT NULL, annee_formation SMALLINT NOT NULL, prescripteur VARCHAR(255) NOT NULL, conseiller VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, portable VARCHAR(255) NOT NULL, fixe VARCHAR(255) NOT NULL, nom_urgence VARCHAR(255) NOT NULL, prenom_urgence VARCHAR(255) NOT NULL, telephone_urgence VARCHAR(255) NOT NULL, lieu_naissance VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL, nationalite VARCHAR(255) NOT NULL, etat_civil VARCHAR(255) NOT NULL, enfants SMALLINT NOT NULL, ordinateur TINYINT(1) NOT NULL, sport TINYINT(1) NOT NULL, droit_image TINYINT(1) NOT NULL, INDEX IDX_383B09B1BDA99777 (educateurs_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entretiens (id INT AUTO_INCREMENT NOT NULL, eleves_id INT NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', commentaire LONGTEXT NOT NULL, INDEX IDX_7D23AC17C2140342 (eleves_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transports (id INT AUTO_INCREMENT NOT NULL, eleves_id INT NOT NULL, transport VARCHAR(255) NOT NULL, INDEX IDX_C7BE69E5C2140342 (eleves_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE absences ADD CONSTRAINT FK_F9C0EFFFC2140342 FOREIGN KEY (eleves_id) REFERENCES eleves (id)');
        $this->addSql('ALTER TABLE documents ADD CONSTRAINT FK_A2B07288C2140342 FOREIGN KEY (eleves_id) REFERENCES eleves (id)');
        $this->addSql('ALTER TABLE eleves ADD CONSTRAINT FK_383B09B1BDA99777 FOREIGN KEY (educateurs_id_id) REFERENCES educateurs (id)');
        $this->addSql('ALTER TABLE entretiens ADD CONSTRAINT FK_7D23AC17C2140342 FOREIGN KEY (eleves_id) REFERENCES eleves (id)');
        $this->addSql('ALTER TABLE transports ADD CONSTRAINT FK_C7BE69E5C2140342 FOREIGN KEY (eleves_id) REFERENCES eleves (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE absences DROP FOREIGN KEY FK_F9C0EFFFC2140342');
        $this->addSql('ALTER TABLE documents DROP FOREIGN KEY FK_A2B07288C2140342');
        $this->addSql('ALTER TABLE eleves DROP FOREIGN KEY FK_383B09B1BDA99777');
        $this->addSql('ALTER TABLE entretiens DROP FOREIGN KEY FK_7D23AC17C2140342');
        $this->addSql('ALTER TABLE transports DROP FOREIGN KEY FK_C7BE69E5C2140342');
        $this->addSql('DROP TABLE absences');
        $this->addSql('DROP TABLE documents');
        $this->addSql('DROP TABLE eleves');
        $this->addSql('DROP TABLE entretiens');
        $this->addSql('DROP TABLE transports');
    }
}
