<?php
require "bootstrap.php";

$router = new \Classes\Router();
//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoices";});
$router->register('/router/',[Classes\Home::class,'index']);
$router->register('/router/invoices', [Classes\Invoices::class, 'index']);
$router->register('/router/invoices/create', [Classes\Invoices::class, 'create']);

echo $router->resolve($_SERVER['REQUEST_URI']);