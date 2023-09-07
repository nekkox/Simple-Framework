<?php
require "bootstrap.php";

$router = new \Classes\Router();
//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoice";});

//Creating routes
$router->get('/router/',[Classes\Home::class,'index']);
$router->get('/router/invoices', [Classes\Invoice::class, 'index']);
$router->get('/router/invoices/create', [Classes\Invoice::class, 'create']);
$router->post('/router/invoices/create', [Classes\Invoice::class, 'store']);

echo $router->resolve($_SERVER['REQUEST_URI'],strtolower($_SERVER['REQUEST_METHOD']));
var_dump($router->routes());