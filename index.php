<?php
require "bootstrap.php";
define('STORAGE_PATH', __DIR__ . '/' . 'app' . '/' . 'storage');
define('VIEW_PATH', __DIR__ . '/../app/views');

use App\App;
use App\Config;
use App\View;
use App\Router;
use App\Container;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;


$container = new \App\Container();
$router = new Router($container);

$router->registerRoutesFromControllerAttributes(
    [
        HomeController::class,
        InvoiceController::class,
        \App\Controllers\PostController::class,
        \App\Controllers\UserController::class,

    ]
);

var_dump($router->routes());
//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoice";});
//Creating routes
$router->get('/router/', [\App\Controllers\HomeController::class, 'index']);
//$router->get('/router/', [HomeController::class, 'attributes']);
$router->get('/router/download', [\App\Controllers\HomeController::class, 'download']);
$router->get('/router/invoices', [\App\Controllers\InvoiceController::class, 'index']);
$router->get('/router/invoices/create', [\App\Controllers\InvoiceController::class, 'create']);
$router->post('/router/invoices/create', [\App\Controllers\InvoiceController::class, 'store']);
$router->post('/router/upload', [\App\Controllers\HomeController::class, 'upload']);
//$router->get('/router/users', function () {
    //echo "Hello World";
//});
//$router->get('/router/posts',[\App\Controllers\PostController::class, 'index']);



(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();


