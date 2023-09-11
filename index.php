<?php
require "bootstrap.php";
define('STORAGE_PATH', __DIR__ . '/' . 'app' . '/' . 'storage');
define('VIEW_PATH', __DIR__ . '/app/views');
use App\View;

try {
    $router = new App\Router();//$router->register('/router/', function() {echo "Home";});
    //$router->register('/router/invoices', function(){ echo "Invoice";});
    //Creating routes
    $router->get('/router/', [\App\Controllers\HomeController::class, 'index']);
    $router->get('/router/download', [\App\Controllers\HomeController::class, 'download']);
    $router->get('/router/invoices', [\App\Controllers\InvoiceController::class, 'index']);
    $router->get('/router/invoices/create', [\App\Controllers\InvoiceController::class, 'create']);
    $router->post('/router/invoices/create', [\App\Controllers\InvoiceController::class, 'store']);
    $router->post('/router/upload', [\App\Controllers\HomeController::class, 'upload']);

    echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

} catch (\App\Exceptions\RouteNotFoundException $e) {

    //header('HTTP/1.1 404 Not Found');
    http_response_code(404);

    echo \App\View::make('errors/error404_view');
}


