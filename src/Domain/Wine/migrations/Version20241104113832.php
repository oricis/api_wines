<?php

declare(strict_types=1);

namespace DomainWineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104113832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE wine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, year SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D81128A2BD76 FOREIGN KEY (wine_id) REFERENCES wine (id)');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D81128A2BS1A FOREIGN KEY (sensor_id) REFERENCES sensor (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE wine');
    }
}
