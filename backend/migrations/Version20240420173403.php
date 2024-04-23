<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240420173403 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE book_management ADD last_booker_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book_management RENAME INDEX idx_d04a3a2a76ed395 TO IDX_94E3DFFCA76ED395');
        $this->addSql('ALTER TABLE book_management RENAME INDEX idx_d04a3a2a16a21262 TO IDX_94E3DFFC16A2B381');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book CHANGE status status VARCHAR(22) DEFAULT \'free\' NOT NULL');
        $this->addSql('ALTER TABLE book_management DROP last_booker_id');
        $this->addSql('ALTER TABLE book_management RENAME INDEX idx_94e3dffca76ed395 TO IDX_D04A3A2A76ED395');
        $this->addSql('ALTER TABLE book_management RENAME INDEX idx_94e3dffc16a2b381 TO IDX_D04A3A2A16A21262');
    }
}
