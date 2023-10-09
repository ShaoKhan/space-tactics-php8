<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930193329 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building_dependencies ADD science_id_id INT NOT NULL, ADD building_level INT NOT NULL, ADD science_level INT NOT NULL');
        $this->addSql('ALTER TABLE building_dependencies ADD CONSTRAINT FK_71F64E021C24C2FD FOREIGN KEY (science_id_id) REFERENCES sciences (id)');
        $this->addSql('CREATE INDEX IDX_71F64E021C24C2FD ON building_dependencies (science_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE building_dependencies DROP FOREIGN KEY FK_71F64E021C24C2FD');
        $this->addSql('DROP INDEX IDX_71F64E021C24C2FD ON building_dependencies');
        $this->addSql('ALTER TABLE building_dependencies DROP science_id_id, DROP building_level, DROP science_level');
    }
}
