<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220520184604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, titre VARCHAR(45) NOT NULL, content VARCHAR(255) NOT NULL, INDEX IDX_FE86641079F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', first_name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, image_filename VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641079F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE TABLE contact (id_contact INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(45) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id_contact)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, horaire VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE installation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, nb_max_personnes INT NOT NULL, duree_utilisation_max VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, identite VARCHAR(255) NOT NULL, duree_moyenne VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rdv (id INT AUTO_INCREMENT NOT NULL, id_installation_id INT DEFAULT NULL, id_professionnel_id INT DEFAULT NULL, date DATETIME NOT NULL, type VARCHAR(45) NOT NULL, tarification DOUBLE PRECISION NOT NULL, INDEX IDX_10C31F86FF254B3C (id_installation_id), INDEX IDX_10C31F8669C39953 (id_professionnel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soin (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description VARCHAR(65535) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F86FF254B3C FOREIGN KEY (id_installation_id) REFERENCES installation (id)');
        $this->addSql('ALTER TABLE rdv ADD CONSTRAINT FK_10C31F8669C39953 FOREIGN KEY (id_professionnel_id) REFERENCES professionnel (id)');
    }


    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641079F37AE5');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F86FF254B3C');
        $this->addSql('ALTER TABLE rdv DROP FOREIGN KEY FK_10C31F8669C39953');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE installation');
        $this->addSql('DROP TABLE professionnel');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE soin');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
