<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190912090848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vinyls_genre DROP FOREIGN KEY FK_EA7B0A0E4296D31F');
        $this->addSql('ALTER TABLE track DROP FOREIGN KEY FK_D6E3F8A6E1F8F7CC');
        $this->addSql('ALTER TABLE vinyls_genre DROP FOREIGN KEY FK_EA7B0A0EE1F8F7CC');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE track');
        $this->addSql('DROP TABLE vinyls');
        $this->addSql('DROP TABLE vinyls_genre');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE track (id INT AUTO_INCREMENT NOT NULL, vinyls_id INT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, duration VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, position VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_D6E3F8A6E1F8F7CC (vinyls_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vinyls (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, artiste VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, label VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, cat_num VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, format VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, country VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, year INT NOT NULL, media_condition VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, sleeve_condition VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantity_stock INT NOT NULL, regular_price INT NOT NULL, reduce_price INT DEFAULT NULL, cover VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE vinyls_genre (vinyls_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_EA7B0A0E4296D31F (genre_id), INDEX IDX_EA7B0A0EE1F8F7CC (vinyls_id), PRIMARY KEY(vinyls_id, genre_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE track ADD CONSTRAINT FK_D6E3F8A6E1F8F7CC FOREIGN KEY (vinyls_id) REFERENCES vinyls (id)');
        $this->addSql('ALTER TABLE vinyls_genre ADD CONSTRAINT FK_EA7B0A0E4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vinyls_genre ADD CONSTRAINT FK_EA7B0A0EE1F8F7CC FOREIGN KEY (vinyls_id) REFERENCES vinyls (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
    }
}
