<?php

declare(strict_types=1);

namespace DomainUserMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241104113754 extends AbstractMigration
{
    private string $sqlCreate = 'CREATE TABLE user (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(100) NOT NULL,
            surname VARCHAR(100) NOT NULL,
            email VARCHAR(180) NOT NULL,
            password VARCHAR(120) NOT NULL,
            api_token VARCHAR(255) DEFAULT NULL,
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
        dump('user migrations');
        try {
            $this->addSql($this->sqlCreate);
            $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6497BA2F5EB ON user (api_token)');
        } catch (\Exception $e) {
            dd(getExceptionStr($e));
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS user');
    }
}
