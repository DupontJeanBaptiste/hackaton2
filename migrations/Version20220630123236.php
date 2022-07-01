<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220630123236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project CHANGE creationdate creationdate DATETIME NOT NULL, CHANGE enddate enddate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE sprint CHANGE creationdate creationdate DATETIME NOT NULL, CHANGE enddate enddate DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user DROP creationdate');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project CHANGE creationdate creationdate VARCHAR(255) NOT NULL, CHANGE enddate enddate VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sprint CHANGE creationdate creationdate VARCHAR(255) NOT NULL, CHANGE enddate enddate VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD creationdate VARCHAR(255) NOT NULL');
    }
}
