<?php

namespace Source\Model;

use PDO;
use Exception;
use PDOStatement;
use Source\Database\MysqlConnection;
use Source\Traits\Attributes;

abstract class Model
{
    use Attributes;

    protected static string $entity;
    protected static array $columns;
    protected static string $primary = 'id';
    protected static bool $timestamp = true;
    protected PDO $connection;
    protected PDOStatement $statement;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;

        $this->connection = (new MysqlConnection())->connection();
    }

    public function save(): bool
    {
        if (isset($this->{static::$primary})) return $this->update();

        return $this->insert();
    }

    protected function insert(): bool
    {
        $this->timestamp('insert');

        $attributes_keys = array_keys($this->attributes);

        $this->checkMandatoryAttributes($attributes_keys);

        $sql = "INSERT INTO " . static::$entity . ' (' . implode(',', $attributes_keys)
            . ') VALUES (:' . implode(', :', $attributes_keys) . ')';

        $stmt = $this->connection->prepare($sql);

        if ($stmt->execute($this->attributes)) return true;

        return false;
    }

    protected function update(): bool
    {
        $this->timestamp('update');

        $attributes_keys = array_keys($this->attributes);

        $this->checkMandatoryAttributes($attributes_keys);

        $sql = 'UPDATE ' . static::$entity . $this->set($attributes_keys)
            . $this->where([static::$primary => $this->{static::$primary}]);

        $stmt = $this->connection->prepare($sql);

        if ($stmt->execute($this->attributes)) return true;

        return false;
    }

    protected function timestamp($insert_or_update): void
    {
        $date = date('Y-m-d H:i:s');

        switch ($insert_or_update) {
            case 'insert':
                $this->created_at = $date;
                break;
            case 'update':
                $this->updated_at = $date;
                break;
        }
    }

    protected function checkMandatoryAttributes($attributes_keys): void
    {
        $required_columns = $this->getRequiredColumns();

        foreach ($required_columns as $column) {
            if (!in_array($column, $attributes_keys))
                throw new Exception('O objeto deve conter todos os atributos obrigatórios'
                    . ' " ' . implode(', ', $required_columns) . ' " ');
        }
    }

    protected function getRequiredColumns(): array
    {
        $required_columns = [];

        foreach (static::$columns as $column => $is_or_not_required) {
            if ($is_or_not_required === 'require') $required_columns[] = $column;
        }

        return $required_columns;
    }

    public static function find(array $filters = [], string $columns = '*')
    {
        return (new static)->getResultFromSelect($filters, $columns);
    }

    public static function all()
    {
        return (new static)->getResultFromSelect();
    }

    public function first(): object|false
    {
        $result = $this->object();

        return empty($result) ? false : $result[0];
    }

    public function fetch(): array
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function object(): array
    {
        $result = $this->fetch();
        $objects = [];

        foreach ($result as $row) {
            $objects[] = new static($row);
        }

        return $objects;
    }

    protected function getResultFromSelect(array $filters = [], string $columns = '*'): static
    {
        $sql = "SELECT {$columns} FROM " . static::$entity
            . $this->where($filters);

        $stmt = $this->connection->prepare($sql);

        if ($stmt->execute($filters))
            $this->statement = $stmt;

        return $this;
    }

    protected function where(array $filters): string
    {
        $sql = ' WHERE 1 = 1 ';

        foreach (array_keys($filters) as $key)
            $sql .= "AND {$key} = :{$key}";

        return $sql;
    }

    protected function set(array $attributes_keys)
    {
        $sql = ' SET ';

        foreach ($attributes_keys as $attribute) {
            $sql .= "{$attribute} = :{$attribute},";
        }

        return substr($sql, 0, -1);
    }
}

// ver a possibilidade de transferir a responsabilidade de efetivamente
// fazer as consultas etc.. para a classe database
// tenho em mente que não preciso guardar o statement visto que o proprio
// objeto model manteria o objeto pdo que teria o statement
