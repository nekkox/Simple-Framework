<?php

namespace App\Models;

use App\Model;

class Invoice extends Model
{


    public function create(int $amount, int $userId) : int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO invoices (amount, user_id) VALUES (:amount, :user_id)'
        );

        $stmt->execute(['amount' => $amount, 'user_id' => $userId]);

        return $this->db->lastInsertId();
    }

    public function find(int $invoiceId)
    {

        $stmt = $this->db->prepare(
            'SELECT invoices.id AS invoice_id, amount, user_id, name
                        FROM invoices
                        INNER JOIN users ON users.id = user_id
                        WHERE invoices.id = :invoiceId'
        );

        $stmt->execute([$invoiceId]);

        $invoice = $stmt->fetch();
        return $invoice ? $invoice : [];
    }

}