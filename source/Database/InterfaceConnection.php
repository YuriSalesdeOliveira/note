<?php

namespace Source\Database;

use PDO;
use PDOException;

interface InterfaceConnection
{
    public function execute(string $query, ?array $params = null): static;

    public function result(): bool|array;

    public function error(): bool|PDOException;
}