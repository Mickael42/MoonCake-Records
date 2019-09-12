<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190912130028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_product (id INT AUTO_INCREMENT NOT NULL, vinyl_id INT NOT NULL, cart_id INT NOT NULL, price INT NOT NULL, quantity INT NOT NULL, INDEX IDX_2530ADE63FFFF645 (vinyl_id), INDEX IDX_2530ADE61AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, ip_address VARCHAR(255) NOT NULL, total_amount INT NOT NULL, INDEX IDX_BA388B719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE63FFFF645 FOREIGN KEY (vinyl_id) REFERENCES vinyl (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE61AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE product_order');
        $this->addSql('ALTER TABLE track CHANGE duration duration INT NOT NULL');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD cart_id INT NOT NULL, CHANGE date_order order_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F52993981AD5CDBF ON `order` (cart_id)');
        $this->addSql('ALTER TABLE vinyl CHANGE reduce_price reduce_price INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE61AD5CDBF');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981AD5CDBF');
        $this->addSql('CREATE TABLE product_order (id INT AUTO_INCREMENT NOT NULL, order_ref_id INT NOT NULL, vinyl_id INT NOT NULL, amount INT NOT NULL, quantity INT NOT NULL, INDEX IDX_5475E8C4E238517C (order_ref_id), INDEX IDX_5475E8C43FFFF645 (vinyl_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C43FFFF645 FOREIGN KEY (vinyl_id) REFERENCES vinyl (id)');
        $this->addSql('ALTER TABLE product_order ADD CONSTRAINT FK_5475E8C4E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE cart');
        $this->addSql('ALTER TABLE client CHANGE user_id user_id INT DEFAULT NULL, CHANGE adress_complement adress_complement VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_F52993981AD5CDBF ON `order`');
        $this->addSql('ALTER TABLE `order` DROP cart_id, CHANGE order_date date_order DATETIME NOT NULL');
        $this->addSql('ALTER TABLE track CHANGE duration duration VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE vinyl CHANGE reduce_price reduce_price INT DEFAULT NULL');
    }
}
