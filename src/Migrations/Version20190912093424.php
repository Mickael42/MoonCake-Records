<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190912093424 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product_order (id INT AUTO_INCREMENT NOT NULL, order_ref_id INT NOT NULL, vinyl_id INT NOT NULL, amount INT NOT NULL, quantity INT NOT NULL, INDEX IDX_5475E8C4E238517C (order_ref_id), INDEX IDX_5475E8C43FFFF645 (vinyl_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C4E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C43FFFF645 FOREIGN KEY (vinyl_id) REFERENCES vinyl (id)');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE vinyl CHANGE reduce_price reduce_price INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product_order');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE vinyl CHANGE reduce_price reduce_price INT DEFAULT NULL');
    }
}
