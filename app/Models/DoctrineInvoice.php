<?php

declare(strict_types = 1);

namespace App\Models;

use App\DoctrineDB;
use App\Enums\InvoiceStatus;
use App\Model;
use PDO;

class DoctrineInvoice
{
    protected DoctrineDB $ddb;

    public function __construct(){
        $this->ddb = new DoctrineDB();
    }

    public function all(InvoiceStatus $status): array
    {

        return $this->ddb->createQueryBuilder()->select('id', 'invoice_number', 'amount', 'status')
            ->from('invoices')
            ->where('status = ?')
            ->setParameter(0, $status->value)
            ->fetchAllAssociative();
    }
}