<?php

namespace App\Models;

use App\Model;

class SignUp extends Model
{
    protected User $userModel;
    protected Invoice $invoiceModel;

    /**
     * @param User $userModel
     * @param Invoice $invoiceModel
     */
    public function __construct(\App\Models\User $userModel, \App\Models\Invoice $invoiceModel)
    {
        $this->userModel = $userModel;
        $this->invoiceModel = $invoiceModel;
        parent::__construct();
    }

    public function register(array $userInfo, array $invoiceInfo): int
    {

        try {
            $this->db->beginTransaction();

            $userId = $this->userModel->create($userInfo['name'], $userInfo['email'], $userInfo['age']);
            $invoiceId = $this->invoiceModel->create($invoiceInfo['amount'], $userId);

            echo "XXX";
            var_dump($invoiceId);
            $this->db->commit();

        } catch (\Throwable $e) {
            echo $e->getMessage();
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
        return $invoiceId;

    }
}