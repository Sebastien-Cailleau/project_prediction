<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201108203016 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prediction (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, pole VARCHAR(255) DEFAULT NULL, best_lap VARCHAR(255) DEFAULT NULL, first VARCHAR(255) DEFAULT NULL, second VARCHAR(255) DEFAULT NULL, third VARCHAR(255) DEFAULT NULL, fourth VARCHAR(255) DEFAULT NULL, fifth VARCHAR(255) DEFAULT NULL, sixth VARCHAR(255) DEFAULT NULL, seventh VARCHAR(255) DEFAULT NULL, eighth VARCHAR(255) DEFAULT NULL, ninth VARCHAR(255) DEFAULT NULL, tenth VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_36396FC8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prediction ADD CONSTRAINT FK_36396FC8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prediction DROP FOREIGN KEY FK_36396FC8A76ED395');
        $this->addSql('DROP TABLE prediction');
        $this->addSql('DROP TABLE user');
    }
}
