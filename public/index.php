<?php
require "../bootstrap.php";
define('STORAGE_PATH', __DIR__ . '/../storage');
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

require_once  __DIR__. '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$container = new \App\Container();
$router = new Router($container);

//method with attributes to register new routes
$router->registerRoutesFromControllerAttributes(
    [
        HomeController::class,
        InvoiceController::class,
        PostController::class,
        UserController::class,
        \App\Controllers\PonyController::class

    ]
);
//echo '<pre>';
//var_dump($router->routes());
//echo '<pre>';
//$router->register('/router/', function() {echo "Home";});
//$router->register('/router/invoices', function(){ echo "Invoice";});
//Creating routes
$router->get('/', [\App\Controllers\HomeController::class, 'index']);
//$router->get('/', [HomeController::class, 'attributes']);
$router->get('/download', [\App\Controllers\HomeController::class, 'download']);
$router->get('/invoices', [\App\Controllers\InvoiceController::class, 'index']);
$router->get('/invoices/create', [\App\Controllers\InvoiceController::class, 'create']);
$router->post('/invoices/create', [\App\Controllers\InvoiceController::class, 'store']);
$router->post('/upload', [\App\Controllers\HomeController::class, 'upload']);
//$router->get('/users', function () {
    //echo "Hello World";
//});
//$router->get('/router/posts',[\App\Controllers\PostController::class, 'index']);



(new App(
    $container,
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();


