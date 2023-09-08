<?php

namespace app\Controllers;

class Invoice
{
    public function index()
    {
        return 'Invoice';
    }

    public function create()
    {
        var_dump($_POST);
        return '<form action="/router/invoice/create" method="post" <label>Amount</label> <input type="text" name="amount">';

    }

    public function store(){
        $amount = $_POST['amount'];
        var_dump($amount);
        echo $amount;
    }

}