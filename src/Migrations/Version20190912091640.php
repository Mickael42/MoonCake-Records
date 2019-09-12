<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190912091640 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE track (id INT AUTO_INCREMENT NOT NULL, vinyl_id INT NOT NULL, name VARCHAR(255) NOT NULL, duration VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, INDEX IDX_D6E3F8A63FFFF645 (vinyl_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vinyl (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, artiste VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, cat_num VARCHAR(255) NOT NULL, format VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, year INT NOT NULL, media_condition VARCHAR(255) NOT NULL, sleeve_condition VARCHAR(255) NOT NULL, quantity_stock INT NOT NULL, regular_price INT NOT NULL, reduce_price INT DEFAULT NULL, cover VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A63FFFF645 FOREIGN KEY (vinyl_id) REFERENCES vinyl (id)');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A63FFFF645');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE vinyl');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
