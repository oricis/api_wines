<?php

declare(strict_types=1);

namespace DomainSensorMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104113818 extends AbstractMigration
{
    private string $sqlCreate = 'CREATE TABLE sensor (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(100) NOT NULL,
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
        dump('sensor migrations');
        try {
            $this->addSql($this->sqlCreate);
        } catch (\Exception $e) {
            dd(getExceptionStr($e));
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS sensor');
    }
}
