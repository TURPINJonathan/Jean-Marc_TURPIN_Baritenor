<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204145118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_article_category (article_id INT NOT NULL, article_category_id INT NOT NULL, INDEX IDX_44F096D97294869C (article_id), INDEX IDX_44F096D988C5F785 (article_category_id), PRIMARY KEY(article_id, article_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_article_category ADD CONSTRAINT FK_44F096D97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_article_category ADD CONSTRAINT FK_44F096D988C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_event DROP FOREIGN KEY FK_4C1978B67294869C');
        $this->addSql('ALTER TABLE article_event DROP FOREIGN KEY FK_4C1978B671F7E88B');
        $this->addSql('DROP TABLE article_event');
        $this->addSql('ALTER TABLE article ADD layout_id INT NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E668C22AA1A FOREIGN KEY (layout_id) REFERENCES article_layout (id)');
        $this->addSql('CREATE INDEX IDX_23A0E668C22AA1A ON article (layout_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_event (article_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_4C1978B67294869C (article_id), INDEX IDX_4C1978B671F7E88B (event_id), PRIMARY KEY(article_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_event ADD CONSTRAINT FK_4C1978B67294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_event ADD CONSTRAINT FK_4C1978B671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_article_category DROP FOREIGN KEY FK_44F096D97294869C');
        $this->addSql('ALTER TABLE article_article_category DROP FOREIGN KEY FK_44F096D988C5F785');
        $this->addSql('DROP TABLE article_article_category');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E668C22AA1A');
        $this->addSql('DROP INDEX IDX_23A0E668C22AA1A ON article');
        $this->addSql('ALTER TABLE article DROP layout_id, DROP created_at');
    }
}
