<?php
require "bootstrap.php";
define('STORAGE_PATH', __DIR__ . '/' . 'app' . '/' . 'storage');
define('VIEW_PATH', __DIR__ . '/../app/views');

use App\App;
use App\Config;
use App\Controllers\PostController;
use App\Controllers\UserController;
use App\View;
use App\Router;
use App\Container;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;


$container = new Container();
$router = new Router($container);

$router->registerRoutesFromControllerAttributes(
    [
        HomeController::class,
        InvoiceController::class,
        PostController::class,
        UserController::class,

    ]
);


//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoice";});
//Creating routes
$router->get('/', [HomeController::class, 'index']);
//$router->get('/router/', [HomeController::class, 'attributes']);
$router->get('/download', [HomeController::class, 'download']);
$router->get('/invoices', [InvoiceController::class, 'index']);
$router->get('/invoices/create', [InvoiceController::class, 'create']);
$router->post('/invoices/create', [InvoiceController::class, 'store']);
$router->post('/upload', [HomeController::class, 'upload']);
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


