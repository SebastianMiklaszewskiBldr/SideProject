<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230911142714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table stocks and products.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE products (id UUID NOT NULL, stock UUID NOT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, amount INT NOT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE INDEX IDX_B3BA5A5A4B365660 ON products (stock)');
        $this->addSql('CREATE TABLE stocks (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql(
            'ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A4B365660 FOREIGN KEY (stock) REFERENCES stocks (id) NOT DEFERRABLE INITIALLY IMMEDIATE'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5A4B365660');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE stocks');
    }
}
