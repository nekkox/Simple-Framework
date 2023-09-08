<?php
require "bootstrap.php";

$router = new app\Router();
//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoice";});

//Creating routes
$router->get('/router/', [\app\Controllers\Home::class, 'index']);
$router->get('/router/invoice', [\app\Controllers\Invoice::class, 'index']);
$router->get('/router/invoice/create', [\app\Controllers\Invoice::class, 'create']);
$router->post('/router/invoice/create', [\app\Controllers\Invoice::class, 'store']);

echo $router->resolve
    ($_SERVER['REQUEST_URI'],
    strtolower($_SERVER['REQUEST_METHOD']));
    var_dump($router->routes()
);