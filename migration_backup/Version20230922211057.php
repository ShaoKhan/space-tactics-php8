<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230922211057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message_types (id INT AUTO_INCREMENT NOT NULL, message_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, from_uuid VARCHAR(255) NOT NULL, from_name VARCHAR(255) NOT NULL, to_uuid VARCHAR(255) NOT NULL, to_name VARCHAR(255) NOT NULL, send_date DATETIME NOT NULL, message LONGTEXT DEFAULT NULL, was_read TINYINT(1) DEFAULT 0 NOT NULL, deleted TINYINT(1) DEFAULT 0 NOT NULL, answered TINYINT(1) DEFAULT 0 NOT NULL, subject VARCHAR(255) NOT NULL, message_type INT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planet_building (id INT AUTO_INCREMENT NOT NULL, planet_id VARCHAR(255) NOT NULL, building_id VARCHAR(255) NOT NULL, building_level INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(255) NOT NULL, datum DATETIME NOT NULL, subject VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, processed_by VARCHAR(255) DEFAULT NULL, processed_since DATETIME DEFAULT NULL, answered TINYINT(1) DEFAULT NULL, closed TINYINT(1) DEFAULT NULL, parent_message INT DEFAULT NULL, username VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('ALTER TABLE buildings ADD planet_building_id INT NOT NULL');
        $this->addSql('ALTER TABLE buildings ADD CONSTRAINT FK_9A51B6A76A9BD80F FOREIGN KEY (planet_building_id) REFERENCES planet_building (id)');
        $this->addSql('CREATE INDEX IDX_9A51B6A76A9BD80F ON buildings (planet_building_id)');
        $this->addSql('ALTER TABLE planet CHANGE terraforming_building terraforming_building INT NOT NULL, CHANGE moonbase_building moonbase_building INT NOT NULL, CHANGE jumpgate_building jumpgate_building INT NOT NULL, CHANGE laserphalanx_building laserphalanx_building INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE buildings DROP FOREIGN KEY FK_9A51B6A76A9BD80F');
        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, logged_at DATETIME NOT NULL, object_id VARCHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, object_class VARCHAR(191) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, version INT NOT NULL, data LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', username VARCHAR(191) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX log_version_lookup_idx (object_id, object_class, version), INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, object_class VARCHAR(191) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, field VARCHAR(32) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, foreign_key VARCHAR(64) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), INDEX general_translations_lookup_idx (object_class, foreign_key), INDEX translations_lookup_idx (locale, object_class, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE message_types');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE planet_building');
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP INDEX IDX_9A51B6A76A9BD80F ON buildings');
        $this->addSql('ALTER TABLE buildings DROP planet_building_id');
        $this->addSql('ALTER TABLE planet CHANGE terraforming_building terraforming_building INT DEFAULT 1, CHANGE moonbase_building moonbase_building INT DEFAULT 1, CHANGE jumpgate_building jumpgate_building INT DEFAULT 1, CHANGE laserphalanx_building laserphalanx_building INT DEFAULT 1');
    }
}
