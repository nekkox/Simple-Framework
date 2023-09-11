<?php

namespace App\Controllers;


use App\View;

class InvoiceController
{
    public function index():View|static
    {
        return View::make('invoices/index_view');
    }

    public function create():View|static
    {
        var_dump($_POST);
        return View::make('invoices/create_view');

    }

    public function store(){
        $amount = $_POST['amount'];
        var_dump($amount);
        echo $amount;
    }

}