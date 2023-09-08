<?php
require "bootstrap.php";
define('STORAGE_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'app'.DIRECTORY_SEPARATOR. 'storage');

$router = new app\Router();
//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoice";});

//Creating routes
$router->get('/router/', [\app\Controllers\HomeController::class, 'index']);
$router->get('/router/invoice', [\app\Controllers\InvoiceController::class, 'index']);
$router->get('/router/invoice/create', [\app\Controllers\InvoiceController::class, 'create']);
$router->post('/router/invoice/create', [\app\Controllers\InvoiceController::class, 'store']);
$router->post('/router/upload', [\app\Controllers\HomeController::class, 'upload']);

echo $router->resolve
    ($_SERVER['REQUEST_URI'],
    strtolower($_SERVER['REQUEST_METHOD']));

var_dump($router->routes());
var_dump(STORAGE_PATH);