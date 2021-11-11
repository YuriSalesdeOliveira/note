<?php

namespace Source\Database;

use PDO;
use PDOException;

class Connection
{
    private PDO $instance;

    public function createConnection(string $driver, array $config): PDO
    {
        [$host, $port, $dbname, $charset,
        $username, $password, $options] = array_values($config);

        if (!isset($this->instance)) {

            try {

                $this->instance = new PDO(
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

        return $this->instance;
    }
}
