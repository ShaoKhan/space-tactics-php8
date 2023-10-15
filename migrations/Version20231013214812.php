<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013214812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'added isBuildable to the building entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planet_building CHANGE planet_id planet_id INT NOT NULL, CHANGE building_id building_id INT NOT NULL');
        $this->addSql('ALTER TABLE planet_building ADD CONSTRAINT FK_92265400A25E9820 FOREIGN KEY (planet_id) REFERENCES planet (id)');
        $this->addSql('ALTER TABLE planet_building ADD CONSTRAINT FK_922654004D2A7E12 FOREIGN KEY (building_id) REFERENCES buildings (id)');
        $this->addSql('CREATE INDEX IDX_92265400A25E9820 ON planet_building (planet_id)');
        $this->addSql('CREATE INDEX IDX_922654004D2A7E12 ON planet_building (building_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE planet_building DROP FOREIGN KEY FK_92265400A25E9820');
        $this->addSql('ALTER TABLE planet_building DROP FOREIGN KEY FK_922654004D2A7E12');
        $this->addSql('DROP INDEX IDX_92265400A25E9820 ON planet_building');
        $this->addSql('DROP INDEX IDX_922654004D2A7E12 ON planet_building');
        $this->addSql('ALTER TABLE planet_building CHANGE planet_id planet_id VARCHAR(255) NOT NULL, CHANGE building_id building_id VARCHAR(255) NOT NULL');
    }
}
