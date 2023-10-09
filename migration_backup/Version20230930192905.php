<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230930192905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE science_dependencies (id INT AUTO_INCREMENT NOT NULL, building_id_id INT NOT NULL, science_id INT NOT NULL, INDEX IDX_C2391B8113E42FCD (building_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE science_dependencies ADD CONSTRAINT FK_C2391B8113E42FCD FOREIGN KEY (building_id_id) REFERENCES buildings (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE science_dependencies DROP FOREIGN KEY FK_C2391B8113E42FCD');
        $this->addSql('DROP TABLE science_dependencies');
    }
}
