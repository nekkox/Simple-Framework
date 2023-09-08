<?php

namespace app\Controllers;

class InvoiceController
{
    public function index()
    {
        return '';
    }

    public function create()
    {
        var_dump($_POST);
        return '';

    }

    public function store(){
        $amount = $_POST['amount'];
        var_dump($amount);
        echo $amount;
    }

}