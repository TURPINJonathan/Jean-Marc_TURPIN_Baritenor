<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240204151529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_event (article_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_4C1978B67294869C (article_id), INDEX IDX_4C1978B671F7E88B (event_id), PRIMARY KEY(article_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_event ADD CONSTRAINT FK_4C1978B67294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_event ADD CONSTRAINT FK_4C1978B671F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_event DROP FOREIGN KEY FK_4C1978B67294869C');
        $this->addSql('ALTER TABLE article_event DROP FOREIGN KEY FK_4C1978B671F7E88B');
        $this->addSql('DROP TABLE article_event');
    }
}
