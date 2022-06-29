<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220629153217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parameter (id INT AUTO_INCREMENT NOT NULL, picture LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, client VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, po VARCHAR(255) NOT NULL, creationdate VARCHAR(255) NOT NULL, enddate VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sprint (id INT AUTO_INCREMENT NOT NULL, project_id INT NOT NULL, number INT NOT NULL, description LONGTEXT NOT NULL, creationdate VARCHAR(255) NOT NULL, enddate VARCHAR(255) NOT NULL, INDEX IDX_EF8055B7166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, sprint_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, label VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, freeacess TINYINT(1) NOT NULL, numberrequire INT NOT NULL, INDEX IDX_938720758C24077B (sprint_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, parameter_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, team VARCHAR(255) NOT NULL, post VARCHAR(255) NOT NULL, creationdate VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6497C56DBD6 (parameter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_project (user_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_77BECEE4A76ED395 (user_id), INDEX IDX_77BECEE4166D1F9C (project_id), PRIMARY KEY(user_id, project_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_tache (user_id INT NOT NULL, tache_id INT NOT NULL, INDEX IDX_7145DB2DA76ED395 (user_id), INDEX IDX_7145DB2DD2235D39 (tache_id), PRIMARY KEY(user_id, tache_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sprint ADD CONSTRAINT FK_EF8055B7166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720758C24077B FOREIGN KEY (sprint_id) REFERENCES sprint (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497C56DBD6 FOREIGN KEY (parameter_id) REFERENCES parameter (id)');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_project ADD CONSTRAINT FK_77BECEE4166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tache ADD CONSTRAINT FK_7145DB2DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_tache ADD CONSTRAINT FK_7145DB2DD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497C56DBD6');
        $this->addSql('ALTER TABLE sprint DROP FOREIGN KEY FK_EF8055B7166D1F9C');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4166D1F9C');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720758C24077B');
        $this->addSql('ALTER TABLE user_tache DROP FOREIGN KEY FK_7145DB2DD2235D39');
        $this->addSql('ALTER TABLE user_project DROP FOREIGN KEY FK_77BECEE4A76ED395');
        $this->addSql('ALTER TABLE user_tache DROP FOREIGN KEY FK_7145DB2DA76ED395');
        $this->addSql('DROP TABLE parameter');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE sprint');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_project');
        $this->addSql('DROP TABLE user_tache');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
