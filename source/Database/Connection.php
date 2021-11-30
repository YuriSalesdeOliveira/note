<?php

namespace Source\Database;

use PDO;
use PDOException;

class Connection extends AbstractDataBase implements InterfaceConnection
{
    protected PDO $PDOConnection;
    protected PDOException $error;
    protected bool|array $result;

    protected function connection(): PDO
    {
        if (!isset($this->PDOConnection)) {

            $this->PDOConnection = $this->createConnection(DATA_BASE_CONFIG);
        }

        return $this->PDOConnection;
    }

    public function execute(string $sql, ?array $params = null): static
    {
        $connection = $this->connection();

        try {
            
            $statement = $connection->prepare($sql);
            $statement->execute($params);
            
            $this->result = $this->modifyOrQuery($sql) === 'query'?
            $statement->fetchAll(PDO::FETCH_ASSOC) :
            true;

        } catch (PDOException $e) {

            $this->error = $e;
            //salvar em arquivo de log
            $this->result = false;
        }

        return $this;
    }

    protected function modifyOrQuery($sql)
    {
        return str_contains(strtolower($sql), 'select') ? 'query' : 'modify';
    }

    public function result(): bool|array
    {
        return $this->result;
    }

    public function error(): bool|PDOException
    {
        if (empty($this->error)) return false;

        return $this->error;
    }
}