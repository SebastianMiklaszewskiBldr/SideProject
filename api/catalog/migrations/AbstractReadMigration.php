<?php

namespace migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class AbstractReadMigration extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->skipIf(
            false === $this->isUsedReadConnection(),
            sprintf('Current migration: %s is not destined for read db.', $this::class)
        );
    }

    public function down(Schema $schema): void
    {
        $this->skipIf(
            false === $this->isUsedReadConnection(),
            sprintf('Current migration: %s is not destined for read db.', $this::class)
        );
    }

    private function isUsedReadConnection(): bool
    {
        $connectionParams = $this->connection->getParams();

        return $connectionParams['host'] === $_ENV['DATABASE_READ_HOST'];
    }
}
