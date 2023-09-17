<?php

namespace App\Services;

class PaddlePayment implements PaymentGatewayInterface
{

    public function charge(array $customer, float $amount, float $tax): bool
    {

       echo "Paddle payment is working".'<br>';
       return true;
    }
}