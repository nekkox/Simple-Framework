<?php
require "bootstrap.php";
define('STORAGE_PATH', __DIR__ . '/' . 'app'.'/'. 'storage');
define('VIEW_PATH', __DIR__ . '/app/views' );


try {
    $router = new app\Router();//$router->register('/router/', function() {echo "Home";});
    //$router->register('/router/invoices', function(){ echo "Invoice";});
    //Creating routes
    $router->get('/router/', [\app\Controllers\HomeController::class, 'index']);
    $router->get('/router/download', [\app\Controllers\HomeController::class, 'download']);
    $router->get('/router/invoices', [\app\Controllers\InvoiceController::class, 'index']);
    $router->get('/router/invoices/create', [\app\Controllers\InvoiceController::class, 'create']);
    $router->post('/router/invoices/create', [\app\Controllers\InvoiceController::class, 'store']);
    $router->post('/router/upload', [\app\Controllers\HomeController::class, 'upload']);

    echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
} catch (\app\Exceptions\RouteNotFoundException $e) {

    //header('HTTP/1.1 404 Not Found');
    http_response_code(404);

  echo \app\View::make('errors/error404_view');
}


