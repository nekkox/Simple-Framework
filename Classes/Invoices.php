<?php

namespace Classes;

class Invoices
{
    public function index()
    {
        return 'Invoices';
    }

    public function create()
    {
        var_dump($_POST);
        return '<form action="/router/invoices/create" method="post" <label>Amount</label> <input type="text" name="amount">';

    }

    public function store(){
        $amount = $_POST['amount'];
        var_dump($amount);
        echo $amount;
    }

}