<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240329183500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE information_item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(20) NOT NULL, UNIQUE INDEX UNIQ_3EB32C035E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE information_stock (id INT AUTO_INCREMENT NOT NULL, stock_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_281192B0DCD6110 (stock_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE information_stock_item (id INT AUTO_INCREMENT NOT NULL, information_stock_id INT DEFAULT NULL, item_id INT DEFAULT NULL, value VARCHAR(50) NOT NULL, INDEX IDX_50913D38AD8F362 (information_stock_id), INDEX IDX_50913D3126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, ticker VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE information_stock ADD CONSTRAINT FK_281192B0DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE information_stock_item ADD CONSTRAINT FK_50913D38AD8F362 FOREIGN KEY (information_stock_id) REFERENCES information_stock (id)');
        $this->addSql('ALTER TABLE information_stock_item ADD CONSTRAINT FK_50913D3126F525E FOREIGN KEY (item_id) REFERENCES information_item (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information_stock DROP FOREIGN KEY FK_281192B0DCD6110');
        $this->addSql('ALTER TABLE information_stock_item DROP FOREIGN KEY FK_50913D38AD8F362');
        $this->addSql('ALTER TABLE information_stock_item DROP FOREIGN KEY FK_50913D3126F525E');
        $this->addSql('DROP TABLE information_item');
        $this->addSql('DROP TABLE information_stock');
        $this->addSql('DROP TABLE information_stock_item');
        $this->addSql('DROP TABLE stock');
    }
}
