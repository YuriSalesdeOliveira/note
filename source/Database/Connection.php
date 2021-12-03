<?php

namespace Source\Database;

use Exception;
use PDO;
use PDOException;

class Connection extends AbstractDataBase implements InterfaceConnection
{
    protected PDO $PDOConnection;
    protected PDOException $error;
    protected array $query_result;

    protected function connection(): PDO
    {
        if (!isset($this->PDOConnection)) {

            $this->PDOConnection = $this->createConnection(DATA_BASE_CONFIG);
        }

        return $this->PDOConnection;
    }

    public function execute(string $sql, ?array $params = null): bool
    {
        $connection = $this->connection();

        try {
            
            $statement = $connection->prepare($sql);
            $statement->execute($params);
            
            if ($this->modifyOrQuery($sql) === 'query')
                $this->query_result = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return true;

        } catch (PDOException $e) {

            $this->error = $e;
            //salvar em arquivo de log
            return false;
        }
    }

    protected function modifyOrQuery($sql)
    {
        return str_contains(strtolower($sql), 'select') ? 'query' : 'modify';
    }

    public function queryResult(): array
    {
        if (!isset($this->query_result))
            throw new Exception('Execute uma consulta para obter um query result.');

        return $this->query_result;
    }

    public function error(): bool|PDOException
    {
        if (empty($this->error)) return false;

        return $this->error;
    }
}