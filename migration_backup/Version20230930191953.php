<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930191953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building_dependencies (id INT AUTO_INCREMENT NOT NULL, building_id_id INT NOT NULL, INDEX IDX_71F64E0213E42FCD (building_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE building_dependencies ADD CONSTRAINT FK_71F64E0213E42FCD FOREIGN KEY (building_id_id) REFERENCES buildings (id)');
        $this->addSql('DROP TABLE dependencies');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dependencies (id INT AUTO_INCREMENT NOT NULL, building_id INT NOT NULL, dependend_building_id INT NOT NULL, required_level INT NOT NULL, dependend_science_id INT NOT NULL, science_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE building_dependencies DROP FOREIGN KEY FK_71F64E0213E42FCD');
        $this->addSql('DROP TABLE building_dependencies');
    }
}
