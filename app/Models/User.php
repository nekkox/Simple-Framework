<?php

namespace App\Models;

use App\App;
use App\Model;

class User extends Model
{

    public function create(string $name, string $email, int $age){

            $stmt = $this->db->prepare('INSERT INTO users (name, email, age) VALUES (:name, :email, :age )');
            $stmt->execute(['name' => $name, 'age' => $age, 'email' => $email]);

       return (int) $this->db->lastInsertId();
}
}