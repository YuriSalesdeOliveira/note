<?php

namespace Source\Database;

use PDO;

interface InterfaceConnection
{
    public function connection(): PDO;
}