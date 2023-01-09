<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109101624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL)');
        $this->addSql('CREATE TABLE commentaires (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id_id INTEGER NOT NULL, manga_id_id INTEGER NOT NULL, contenu VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , note SMALLINT NOT NULL, CONSTRAINT FK_D9BEC0C475F8742E FOREIGN KEY (auteur_id_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D9BEC0C4E9126230 FOREIGN KEY (manga_id_id) REFERENCES mangas (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C475F8742E ON commentaires (auteur_id_id)');
        $this->addSql('CREATE INDEX IDX_D9BEC0C4E9126230 ON commentaires (manga_id_id)');
        $this->addSql('CREATE TABLE mangas (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, date_parution DATE NOT NULL, nb_tomes INTEGER NOT NULL, statut SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, CONSTRAINT FK_8271C42F75F8742E FOREIGN KEY (auteur_id_id) REFERENCES auteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8271C42F75F8742E ON mangas (auteur_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE mangas');
    }
}
