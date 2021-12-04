<?php

namespace Source\Database;

use PDO;
use PDOException;

abstract class AbstractDataBase
{
    protected function createConnection(array $config): PDO
    {
        [$driver, $host, $port, $dbname, $charset,
        $username, $password, $options] = array_values($config);

        try {

            return new PDO(
                "{$driver}:host={$host};
                    port={$port};dbname={$dbname};charset={$charset}",
                $username,
                $password,
                $options
            );

        } catch (PDOException $e) {
            die('Erro no banco: ' . $e->getMessage());
            // não esquecer que tenho que guardar esses erros em algum arquivo
        }
    }
}