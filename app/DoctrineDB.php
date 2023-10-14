<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;


class DoctrineDB
{
    private Connection $connection;

    public function __construct()
    {

        $connectionParams = [
            'dbname' => 'my_db',
            'user' => 'root',
            'password' => 'root',
            'host' => 'db',
            'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
        ];

        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->connection, $name], $arguments);
    }
}