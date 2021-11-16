<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211115172755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE addon (id INT AUTO_INCREMENT NOT NULL, related_order_item_id INT NOT NULL, related_product_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_D185917FC47318A (related_order_item_id), INDEX IDX_D185917FCF496EEA (related_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, street_no DOUBLE PRECISION NOT NULL, city VARCHAR(255) NOT NULL, postcode DOUBLE PRECISION NOT NULL, floor VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, note VARCHAR(255) NOT NULL, prefered_delivery_time VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C744045519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, rating_id INT NOT NULL, name VARCHAR(255) NOT NULL, imprint VARCHAR(255) NOT NULL, min_delivery_amount DOUBLE PRECISION NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_4FBF094FA32EFC6 (rating_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_delivery_time (company_id INT NOT NULL, delivery_time_id INT NOT NULL, INDEX IDX_C22A72A2979B1AD6 (company_id), INDEX IDX_C22A72A254F462E5 (delivery_time_id), PRIMARY KEY(company_id, delivery_time_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, related_order_id INT NOT NULL, number DOUBLE PRECISION NOT NULL, string VARCHAR(255) NOT NULL, INDEX IDX_64BF3F022B1C2395 (related_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE delivery_time (id INT AUTO_INCREMENT NOT NULL, sender VARCHAR(255) NOT NULL, receiver VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, sender VARCHAR(255) NOT NULL, receiver VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, INDEX IDX_E7927C74979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE link (id INT AUTO_INCREMENT NOT NULL, related_payment_id INT NOT NULL, href VARCHAR(255) NOT NULL, rel VARCHAR(255) NOT NULL, method VARCHAR(255) NOT NULL, INDEX IDX_36AC99F18E0EAB0B (related_payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, status_id INT NOT NULL, client_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, delivery_date DATETIME NOT NULL, complete TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F52993986BF700BD (status_id), INDEX IDX_F529939819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, related_order_id INT NOT NULL, product_id INT NOT NULL, count INT NOT NULL, INDEX IDX_52EA1F092B1C2395 (related_order_id), INDEX IDX_52EA1F094584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, payment_status_id INT NOT NULL, client_id INT NOT NULL, coupon_id INT NOT NULL, related_company_id INT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6D28840D28DE2F95 (payment_status_id), INDEX IDX_6D28840D19EB6921 (client_id), UNIQUE INDEX UNIQ_6D28840D66C5951B (coupon_id), INDEX IDX_6D28840D1D561266 (related_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_status (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postcode (id INT AUTO_INCREMENT NOT NULL, related_company_id INT NOT NULL, number DOUBLE PRECISION NOT NULL, longitude VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, INDEX IDX_6339A4111D561266 (related_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, info VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, in_stock TINYINT(1) NOT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, number DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE addon ADD CONSTRAINT FK_D185917FC47318A FOREIGN KEY (related_order_item_id) REFERENCES order_item (id)');
        $this->addSql('ALTER TABLE addon ADD CONSTRAINT FK_D185917FCF496EEA FOREIGN KEY (related_product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045519EB6921 FOREIGN KEY (client_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FA32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id)');
        $this->addSql('ALTER TABLE company_delivery_time ADD CONSTRAINT FK_C22A72A2979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE company_delivery_time ADD CONSTRAINT FK_C22A72A254F462E5 FOREIGN KEY (delivery_time_id) REFERENCES delivery_time (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coupon ADD CONSTRAINT FK_64BF3F022B1C2395 FOREIGN KEY (related_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C74979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE link ADD CONSTRAINT FK_36AC99F18E0EAB0B FOREIGN KEY (related_payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993986BF700BD FOREIGN KEY (status_id) REFERENCES order_status (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F092B1C2395 FOREIGN KEY (related_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F094584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D28DE2F95 FOREIGN KEY (payment_status_id) REFERENCES payment_status (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D66C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D1D561266 FOREIGN KEY (related_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE postcode ADD CONSTRAINT FK_6339A4111D561266 FOREIGN KEY (related_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C744045519EB6921');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939819EB6921');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D19EB6921');
        $this->addSql('ALTER TABLE company_delivery_time DROP FOREIGN KEY FK_C22A72A2979B1AD6');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C74979B1AD6');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D1D561266');
        $this->addSql('ALTER TABLE postcode DROP FOREIGN KEY FK_6339A4111D561266');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D66C5951B');
        $this->addSql('ALTER TABLE company_delivery_time DROP FOREIGN KEY FK_C22A72A254F462E5');
        $this->addSql('ALTER TABLE coupon DROP FOREIGN KEY FK_64BF3F022B1C2395');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F092B1C2395');
        $this->addSql('ALTER TABLE addon DROP FOREIGN KEY FK_D185917FC47318A');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993986BF700BD');
        $this->addSql('ALTER TABLE link DROP FOREIGN KEY FK_36AC99F18E0EAB0B');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D28DE2F95');
        $this->addSql('ALTER TABLE addon DROP FOREIGN KEY FK_D185917FCF496EEA');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F094584665A');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FA32EFC6');
        $this->addSql('DROP TABLE addon');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE company_delivery_time');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE delivery_time');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE link');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_status');
        $this->addSql('DROP TABLE postcode');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE rating');
    }
}
