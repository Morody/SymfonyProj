<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210090812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description_video DROP FOREIGN KEY FK_66EB06CE29C1004E');
        $this->addSql('DROP INDEX IDX_66EB06CE29C1004E ON description_video');
        $this->addSql('ALTER TABLE description_video DROP video_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description_video ADD video_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE description_video ADD CONSTRAINT FK_66EB06CE29C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_66EB06CE29C1004E ON description_video (video_id)');
    }
}
