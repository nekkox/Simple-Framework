<?php
require "bootstrap.php";

$router = new \Classes\Router();
//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoices";});
$router->get('/router/',[Classes\Home::class,'index']);
$router->get('/router/invoices', [Classes\Invoices::class, 'index']);
$router->get('/router/invoices/create', [Classes\Invoices::class, 'create']);
$router->post('/router/invoices/create', [Classes\Invoices::class, 'store']);

echo $router->resolve($_SERVER['REQUEST_URI'],strtolower($_SERVER['REQUEST_METHOD']));