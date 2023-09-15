<?php

namespace App\Xml;

class DBLogger implements ILogger
{
    private \PDO $db;
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
       // $this->db = $db;
    }

    public function log(string $request, int $priority): bool
    {
        $sql = "INSERT INTO transaction_log(priority, timestamp, data)
                VALUES (:priority, :timestamp, :data)";
        $statement = $this->db->prepare($sql);
        $timestamp = time();

        $statement->bindParam(':priority', $priority, \PDO::PARAM_INT);
        $statement->bindParam(':timestamp', $timestamp, \PDO::PARAM_INT);
        $statement->bindParam(':data', $request, \PDO::PARAM_STR);

        return $statement->execute();
    }
}
