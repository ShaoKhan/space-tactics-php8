<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230929204005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buildings ADD building_class INT NOT NULL, ADD one_per_planet TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buildings DROP building_class, DROP one_per_planet');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }
}
