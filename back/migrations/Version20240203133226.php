<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240203133226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_place_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, details LONGTEXT DEFAULT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA74B4A4BC9 (event_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_place (id INT AUTO_INCREMENT NOT NULL, event_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, geo_coordinates JSON NOT NULL, INDEX IDX_3506E2E1401B253C (event_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74B4A4BC9 FOREIGN KEY (event_place_id) REFERENCES event_place (id)');
        $this->addSql('ALTER TABLE event_place ADD CONSTRAINT FK_3506E2E1401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74B4A4BC9');
        $this->addSql('ALTER TABLE event_place DROP FOREIGN KEY FK_3506E2E1401B253C');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_place');
        $this->addSql('DROP TABLE event_type');
    }
}
