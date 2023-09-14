<?php

declare(strict_types=1);

namespace DoctrineMigrationsRead;

use Doctrine\DBAL\Schema\Schema;
use DoctrineMigrations\AbstractReadMigration;

final class Version20230914073912 extends AbstractReadMigration
{
    public function getDescription(): string
    {
        return 'Create \"project_overview\" table.';
    }

    public function up(Schema $schema): void
    {
        parent::up($schema);

        $this->addSql(
            'CREATE TABLE product_overview (id UUID NOT NULL, name VARCHAR(255) NOT NULL, amount INT NOT NULL, stock_id UUID NOT NULL, stock_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))'
        );
    }

    public function down(Schema $schema): void
    {
        parent::down($schema);

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE product_overview');
    }
}
