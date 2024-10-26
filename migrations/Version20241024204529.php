<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241024204529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Se crea migración para añadir la información de las acciones que han fallado en el proceso de finviz';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE information_stock_reject (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, ticker VARCHAR(30) NOT NULL, stock_name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE information_stock_reject');
    }
}
