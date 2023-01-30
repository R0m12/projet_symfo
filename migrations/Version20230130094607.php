<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230130094607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE auteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaires (id INT AUTO_INCREMENT NOT NULL, auteur_id_id INT NOT NULL, manga_id_id INT NOT NULL, contenu VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', note SMALLINT NOT NULL, INDEX IDX_D9BEC0C475F8742E (auteur_id_id), INDEX IDX_D9BEC0C4E9126230 (manga_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mangas (id INT AUTO_INCREMENT NOT NULL, auteur_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date_parution DATE NOT NULL, nb_tomes INT NOT NULL, statut SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_8271C42F75F8742E (auteur_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C475F8742E FOREIGN KEY (auteur_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaires ADD CONSTRAINT FK_D9BEC0C4E9126230 FOREIGN KEY (manga_id_id) REFERENCES mangas (id)');
        $this->addSql('ALTER TABLE mangas ADD CONSTRAINT FK_8271C42F75F8742E FOREIGN KEY (auteur_id_id) REFERENCES auteur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C475F8742E');
        $this->addSql('ALTER TABLE commentaires DROP FOREIGN KEY FK_D9BEC0C4E9126230');
        $this->addSql('ALTER TABLE mangas DROP FOREIGN KEY FK_8271C42F75F8742E');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE commentaires');
        $this->addSql('DROP TABLE mangas');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
