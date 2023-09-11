<?php
require "bootstrap.php";
define('STORAGE_PATH', __DIR__ . '/' . 'app' . '/' . 'storage');
define('VIEW_PATH', __DIR__ . '/app/views');

use App\App;
use App\View;
use App\Router;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;

    $router = new Router();//$router->register('/router/', function() {echo "Home";});
    //$router->register('/router/invoices', function(){ echo "Invoice";});
    //Creating routes
    $router->get('/router/', [\App\Controllers\HomeController::class, 'index']);
    $router->get('/router/download', [\App\Controllers\HomeController::class, 'download']);
    $router->get('/router/invoices', [\App\Controllers\InvoiceController::class, 'index']);
    $router->get('/router/invoices/create', [\App\Controllers\InvoiceController::class, 'create']);
    $router->post('/router/invoices/create', [\App\Controllers\InvoiceController::class, 'store']);
    $router->post('/router/upload', [\App\Controllers\HomeController::class, 'upload']);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    [
        'host'  => $_ENV['DB_HOST'],
        'user'  => $_ENV['DB_USER'],
        'pass'  => $_ENV['DB_PASS'],
        'database'  => $_ENV['DB_DATABASE'],
        'driver'  => $_ENV['DB_DRIVER'] ?? 'mysql',
    ]

))->run();


