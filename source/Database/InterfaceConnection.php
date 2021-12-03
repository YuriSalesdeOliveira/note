<?php

namespace Source\Database;

use PDO;
use PDOException;

interface InterfaceConnection
{
    public function execute(string $sql, ?array $params = null): bool;

    public function queryResult(): array;

    public function error(): bool|PDOException;
}