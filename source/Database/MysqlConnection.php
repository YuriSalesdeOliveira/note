<?php

namespace Source\Database;

use PDO;
use Source\Database\InterfaceConnection;

class MysqlConnection extends Connection implements InterfaceConnection {

    public function connection(): PDO
    {
        return $this->createConnection('mysql', DB_CONNECTION_CONFIG);
    }

}

