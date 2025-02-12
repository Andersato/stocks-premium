<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250202185130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Añadir medias móviles de 10, 20 y 50 sesiones diarias';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information_stock ADD ma10 DOUBLE PRECISION DEFAULT NULL, ADD ma20 DOUBLE PRECISION DEFAULT NULL, ADD ma50 DOUBLE PRECISION DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE information_stock DROP ma10, DROP ma20, DROP ma50');
    }
}
