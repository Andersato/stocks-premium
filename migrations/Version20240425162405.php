<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240425162405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information_stock_item DROP FOREIGN KEY FK_50913D3126F525E');
        $this->addSql('ALTER TABLE information_stock_item DROP FOREIGN KEY FK_50913D38AD8F362');
        $this->addSql('DROP TABLE information_stock_item');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE information_stock_item (id INT AUTO_INCREMENT NOT NULL, information_stock_id INT DEFAULT NULL, item_id INT DEFAULT NULL, value VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_50913D38AD8F362 (information_stock_id), INDEX IDX_50913D3126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE information_stock_item ADD CONSTRAINT FK_50913D3126F525E FOREIGN KEY (item_id) REFERENCES information_item (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE information_stock_item ADD CONSTRAINT FK_50913D38AD8F362 FOREIGN KEY (information_stock_id) REFERENCES information_stock (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
