<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930201552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building_dependencies DROP FOREIGN KEY FK_71F64E0213E42FCD');
        $this->addSql('ALTER TABLE building_dependencies DROP FOREIGN KEY FK_71F64E021C24C2FD');
        $this->addSql('ALTER TABLE building_dependencies_buildings DROP FOREIGN KEY FK_B673D9405FE1248D');
        $this->addSql('ALTER TABLE building_dependencies_buildings DROP FOREIGN KEY FK_B673D9401485E613');
        $this->addSql('ALTER TABLE science_dependencies DROP FOREIGN KEY FK_C2391B8113E42FCD');
        $this->addSql('DROP TABLE building_dependencies');
        $this->addSql('DROP TABLE building_dependencies_buildings');
        $this->addSql('DROP TABLE science_dependencies');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building_dependencies (id INT AUTO_INCREMENT NOT NULL, building_id_id INT DEFAULT NULL, science_id_id INT DEFAULT NULL, building_level INT DEFAULT NULL, science_level INT DEFAULT NULL, INDEX IDX_71F64E0213E42FCD (building_id_id), INDEX IDX_71F64E021C24C2FD (science_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE building_dependencies_buildings (building_dependencies_id INT NOT NULL, buildings_id INT NOT NULL, INDEX IDX_B673D9401485E613 (buildings_id), INDEX IDX_B673D9405FE1248D (building_dependencies_id), PRIMARY KEY(building_dependencies_id, buildings_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE science_dependencies (id INT AUTO_INCREMENT NOT NULL, building_id_id INT NOT NULL, building_level INT NOT NULL, science_id INT NOT NULL, science_level INT NOT NULL, INDEX IDX_C2391B8113E42FCD (building_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE building_dependencies ADD CONSTRAINT FK_71F64E0213E42FCD FOREIGN KEY (building_id_id) REFERENCES buildings (id)');
        $this->addSql('ALTER TABLE building_dependencies ADD CONSTRAINT FK_71F64E021C24C2FD FOREIGN KEY (science_id_id) REFERENCES sciences (id)');
        $this->addSql('ALTER TABLE building_dependencies_buildings ADD CONSTRAINT FK_B673D9405FE1248D FOREIGN KEY (building_dependencies_id) REFERENCES building_dependencies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE building_dependencies_buildings ADD CONSTRAINT FK_B673D9401485E613 FOREIGN KEY (buildings_id) REFERENCES buildings (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE science_dependencies ADD CONSTRAINT FK_C2391B8113E42FCD FOREIGN KEY (building_id_id) REFERENCES buildings (id)');
    }
}
