<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218091757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, layout_id INT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_23A0E668C22AA1A (layout_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_article_category (article_id INT NOT NULL, article_category_id INT NOT NULL, INDEX IDX_44F096D97294869C (article_id), INDEX IDX_44F096D988C5F785 (article_category_id), PRIMARY KEY(article_id, article_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_event (article_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_4C1978B67294869C (article_id), INDEX IDX_4C1978B671F7E88B (event_id), PRIMARY KEY(article_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_layout (id INT AUTO_INCREMENT NOT NULL, choice INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, event_place_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, details LONGTEXT DEFAULT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA74B4A4BC9 (event_place_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_place (id INT AUTO_INCREMENT NOT NULL, event_type_id INT NOT NULL, name VARCHAR(255) NOT NULL, latitude NUMERIC(15, 13) NOT NULL, longitude NUMERIC(15, 13) NOT NULL, city VARCHAR(100) NOT NULL, INDEX IDX_3506E2E1401B253C (event_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E668C22AA1A FOREIGN KEY (layout_id) REFERENCES article_layout (id)');
        $this->addSql('ALTER TABLE article_article_category ADD CONSTRAINT FK_44F096D97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_article_category ADD CONSTRAINT FK_44F096D988C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_event ADD CONSTRAINT FK_4C1978B67294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_event ADD CONSTRAINT FK_4C1978B671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA74B4A4BC9 FOREIGN KEY (event_place_id) REFERENCES event_place (id)');
        $this->addSql('ALTER TABLE event_place ADD CONSTRAINT FK_3506E2E1401B253C FOREIGN KEY (event_type_id) REFERENCES event_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E668C22AA1A');
        $this->addSql('ALTER TABLE article_article_category DROP FOREIGN KEY FK_44F096D97294869C');
        $this->addSql('ALTER TABLE article_article_category DROP FOREIGN KEY FK_44F096D988C5F785');
        $this->addSql('ALTER TABLE article_event DROP FOREIGN KEY FK_4C1978B67294869C');
        $this->addSql('ALTER TABLE article_event DROP FOREIGN KEY FK_4C1978B671F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA74B4A4BC9');
        $this->addSql('ALTER TABLE event_place DROP FOREIGN KEY FK_3506E2E1401B253C');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_article_category');
        $this->addSql('DROP TABLE article_event');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE article_layout');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_place');
        $this->addSql('DROP TABLE event_type');
        $this->addSql('DROP TABLE user');
    }
}
