<?php

declare(strict_types=1);

namespace DomainMeasurementMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104113808 extends AbstractMigration
{
    private string $sqlCreate = 'CREATE TABLE measurement (
            id INT AUTO_INCREMENT NOT NULL,
            year SMALLINT NOT NULL,
            color VARCHAR(32) NOT NULL,
            temperature SMALLINT NOT NULL,
            ph DOUBLE PRECISION NOT NULL,
            alcohol_content SMALLINT NOT NULL,
            sensor_id INT NOT NULL,
            wine_id INT NOT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4
            COLLATE `utf8mb4_unicode_ci`
            ENGINE = InnoDB';


    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        dump('measurement migrations');
        try {
            $this->addSql($this->sqlCreate);
        } catch (\Exception $e) {
            dd(getExceptionStr($e));
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS measurement');
    }
}
