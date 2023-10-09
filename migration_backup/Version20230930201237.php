<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930201237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building_dependencies_buildings (building_dependencies_id INT NOT NULL, buildings_id INT NOT NULL, INDEX IDX_B673D9405FE1248D (building_dependencies_id), INDEX IDX_B673D9401485E613 (buildings_id), PRIMARY KEY(building_dependencies_id, buildings_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE building_dependencies_buildings ADD CONSTRAINT FK_B673D9405FE1248D FOREIGN KEY (building_dependencies_id) REFERENCES building_dependencies (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE building_dependencies_buildings ADD CONSTRAINT FK_B673D9401485E613 FOREIGN KEY (buildings_id) REFERENCES buildings (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building_dependencies_buildings DROP FOREIGN KEY FK_B673D9405FE1248D');
        $this->addSql('ALTER TABLE building_dependencies_buildings DROP FOREIGN KEY FK_B673D9401485E613');
        $this->addSql('DROP TABLE building_dependencies_buildings');
    }
}
