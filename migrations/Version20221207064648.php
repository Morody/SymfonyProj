<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207064648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description_video ADD owner_description_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE description_video ADD CONSTRAINT FK_66EB06CE49E00EEE FOREIGN KEY (owner_description_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_66EB06CE49E00EEE ON description_video (owner_description_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description_video DROP FOREIGN KEY FK_66EB06CE49E00EEE');
        $this->addSql('DROP INDEX UNIQ_66EB06CE49E00EEE ON description_video');
        $this->addSql('ALTER TABLE description_video DROP owner_description_id');
    }
}
