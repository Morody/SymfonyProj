<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217181351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description_video DROP INDEX UNIQ_66EB06CE49E00EEE, ADD INDEX IDX_66EB06CE49E00EEE (owner_description_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description_video DROP INDEX IDX_66EB06CE49E00EEE, ADD UNIQUE INDEX UNIQ_66EB06CE49E00EEE (owner_description_id)');
    }
}
