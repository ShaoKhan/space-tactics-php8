<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221221203836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE buildings (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, factor DOUBLE PRECISION DEFAULT NULL, level_max INT NOT NULL, cost_metal INT NOT NULL, cost_crystal INT NOT NULL, cost_deuterium INT NOT NULL, cost_dark_matter INT NOT NULL, cost_energy INT NOT NULL, storage_metal DOUBLE PRECISION DEFAULT NULL, storage_crystal DOUBLE PRECISION DEFAULT NULL, storage_deuterium DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE buildings');
    }
}
