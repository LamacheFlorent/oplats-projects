<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230822080940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author_recipe (author_id INT NOT NULL, recipe_id INT NOT NULL, INDEX IDX_3F4B871AF675F31B (author_id), INDEX IDX_3F4B871A59D8A214 (recipe_id), PRIMARY KEY(author_id, recipe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE author_recipe ADD CONSTRAINT FK_3F4B871AF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE author_recipe ADD CONSTRAINT FK_3F4B871A59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE review ADD recipe_id INT DEFAULT NULL, ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('CREATE INDEX IDX_794381C659D8A214 ON review (recipe_id)');
        $this->addSql('CREATE INDEX IDX_794381C6F675F31B ON review (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE author_recipe DROP FOREIGN KEY FK_3F4B871AF675F31B');
        $this->addSql('ALTER TABLE author_recipe DROP FOREIGN KEY FK_3F4B871A59D8A214');
        $this->addSql('DROP TABLE author_recipe');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C659D8A214');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6F675F31B');
        $this->addSql('DROP INDEX IDX_794381C659D8A214 ON review');
        $this->addSql('DROP INDEX IDX_794381C6F675F31B ON review');
        $this->addSql('ALTER TABLE review DROP recipe_id, DROP author_id');
    }
}
