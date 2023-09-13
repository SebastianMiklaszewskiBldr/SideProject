<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

abstract class AbstractWriteMigration extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->skipIf(
            false === $this->isUsedWriteConnection(),
            sprintf('Current migration: %s is not destined for write db.', self::class)
        );
    }

    private function isUsedWriteConnection(): bool
    {
        $connectionParams = $this->connection->getParams();

        return $connectionParams['host'] === $_ENV['DATABASE_WRITE_HOST'];
    }

    public function down(Schema $schema): void
    {
        $this->skipIf(
            false === $this->isUsedWriteConnection(),
            sprintf('Current migration: %s is not destined for write db.', self::class)
        );
    }
}
