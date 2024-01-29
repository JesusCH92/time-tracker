<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129014418 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO task (name) VALUES (\'TASK 1\')');
        $this->addSql('INSERT INTO task (name) VALUES (\'TASK 2\')');
        $this->addSql('INSERT INTO task (name) VALUES (\'TASK 3\')');
        $this->addSql('INSERT INTO task (name) VALUES (\'TASK 4\')');
        $this->addSql('INSERT INTO task (name) VALUES (\'TASK 5\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
