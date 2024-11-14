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
    private string $sqlCreate = 'CREATE TABLE wine (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(100) NOT NULL,
            year SMALLINT NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4
            COLLATE `utf8mb4_unicode_ci`
            ENGINE = InnoDB';
    private string $sqlFkToSensor = 'ALTER TABLE measurement
        ADD CONSTRAINT FK_2CE0D81128A2BS1A
        FOREIGN KEY (sensor_id)
        REFERENCES sensor (id)';
    private string $sqlFkToWine = 'ALTER TABLE measurement
        ADD CONSTRAINT FK_2CE0D81128A2BD76
        FOREIGN KEY (wine_id)
        REFERENCES wine (id)';


    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        dump('wine migrations');
        try {
            $this->addSql($this->sqlCreate);

            dump('wine migrations - adding constraints to measurement...');
            $this->addSql($this->sqlFkToSensor);
            $this->addSql($this->sqlFkToWine);
        } catch (\Exception $e) {
            dd(getExceptionStr($e));
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS wine');
    }
}
