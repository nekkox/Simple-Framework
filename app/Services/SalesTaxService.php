<?php

namespace App\Services;

class SalesTaxService
{
    public function calculate(float $amount, array $customer ):float
    {
        //sleep(1);
        return (float) $amount * 6.5 / 100;

        }
}