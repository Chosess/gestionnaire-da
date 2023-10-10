<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922091031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleves CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL, CHANGE civilite civilite VARCHAR(255) DEFAULT NULL, CHANGE validation_inscription validation_inscription TINYINT(1) DEFAULT NULL, CHANGE date_inscription date_inscription DATETIME DEFAULT NULL, CHANGE formation formation VARCHAR(255) DEFAULT NULL, CHANGE niveau_formation niveau_formation VARCHAR(255) DEFAULT NULL, CHANGE annee_formation annee_formation SMALLINT DEFAULT NULL, CHANGE prescripteur prescripteur VARCHAR(255) DEFAULT NULL, CHANGE conseiller conseiller VARCHAR(255) DEFAULT NULL, CHANGE adresse adresse VARCHAR(255) DEFAULT NULL, CHANGE code_postal code_postal VARCHAR(255) DEFAULT NULL, CHANGE ville ville VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE portable portable VARCHAR(255) DEFAULT NULL, CHANGE fixe fixe VARCHAR(255) DEFAULT NULL, CHANGE nom_urgence nom_urgence VARCHAR(255) DEFAULT NULL, CHANGE prenom_urgence prenom_urgence VARCHAR(255) DEFAULT NULL, CHANGE telephone_urgence telephone_urgence VARCHAR(255) DEFAULT NULL, CHANGE lieu_naissance lieu_naissance VARCHAR(255) DEFAULT NULL, CHANGE date_naissance date_naissance DATETIME DEFAULT NULL, CHANGE nationalite nationalite VARCHAR(255) DEFAULT NULL, CHANGE etat_civil etat_civil VARCHAR(255) DEFAULT NULL, CHANGE enfants enfants SMALLINT DEFAULT NULL, CHANGE ordinateur ordinateur TINYINT(1) DEFAULT NULL, CHANGE sport sport TINYINT(1) DEFAULT NULL, CHANGE droit_image droit_image TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleves CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL, CHANGE civilite civilite VARCHAR(255) NOT NULL, CHANGE validation_inscription validation_inscription TINYINT(1) NOT NULL, CHANGE date_inscription date_inscription DATETIME NOT NULL, CHANGE formation formation VARCHAR(255) NOT NULL, CHANGE niveau_formation niveau_formation VARCHAR(255) NOT NULL, CHANGE annee_formation annee_formation SMALLINT NOT NULL, CHANGE prescripteur prescripteur VARCHAR(255) NOT NULL, CHANGE conseiller conseiller VARCHAR(255) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE code_postal code_postal VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE portable portable VARCHAR(255) NOT NULL, CHANGE fixe fixe VARCHAR(255) NOT NULL, CHANGE nom_urgence nom_urgence VARCHAR(255) NOT NULL, CHANGE prenom_urgence prenom_urgence VARCHAR(255) NOT NULL, CHANGE telephone_urgence telephone_urgence VARCHAR(255) NOT NULL, CHANGE lieu_naissance lieu_naissance VARCHAR(255) NOT NULL, CHANGE date_naissance date_naissance DATETIME NOT NULL, CHANGE nationalite nationalite VARCHAR(255) NOT NULL, CHANGE etat_civil etat_civil VARCHAR(255) NOT NULL, CHANGE enfants enfants SMALLINT NOT NULL, CHANGE ordinateur ordinateur TINYINT(1) NOT NULL, CHANGE sport sport TINYINT(1) NOT NULL, CHANGE droit_image droit_image TINYINT(1) NOT NULL');
    }
}
