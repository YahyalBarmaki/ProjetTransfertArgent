<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190802144003 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_partenaire (user_id INT NOT NULL, partenaire_id INT NOT NULL, INDEX IDX_9598659FA76ED395 (user_id), INDEX IDX_9598659F98DE13AC (partenaire_id), PRIMARY KEY(user_id, partenaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_partenaire ADD CONSTRAINT FK_9598659FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_partenaire ADD CONSTRAINT FK_9598659F98DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP tel');
        $this->addSql('DROP INDEX IDX_32FFA373A76ED395 ON partenaire');
        $this->addSql('ALTER TABLE partenaire DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user_partenaire');
        $this->addSql('ALTER TABLE partenaire ADD user_id INT NOT NULL');
        $this->addSql('CREATE INDEX IDX_32FFA373A76ED395 ON partenaire (user_id)');
        $this->addSql('ALTER TABLE user ADD tel VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
