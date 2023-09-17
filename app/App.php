<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Router;
use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;

class App
{
    private Router $router;
    protected array $request;
    private static DB $db;
    public static Container $container;
    protected Config $config;

    public static $one;


    public function __construct(Router $router, array $request, Config $config)
    {
        $this->router = $router;
        $this->request = $request;
        $this->config = $config;
        static::$db = new DB($config->db ?? []);
        /*static::$container = new Container();

        static::$container->set(SalesTaxService::class, fn() => new SalesTaxService());
        static::$container->set(EmailService::class, fn() => new EmailService());
        static::$container->set(PaymentGatewayService::class, fn() => new PaymentGatewayService());

        static::$container->set(InvoiceService::class, function (Container $container) {
            return new InvoiceService(
                $container->get(SalesTaxService::class),
                $container->get(EmailService::class),
                $container->get(PaymentGatewayService::class),
            );
        }
        );*/
    }

    public static function db(): DB
    {
        return static::$db;
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve(
                $this->request['uri'],
                strtolower($this->request['method'])
            );
        } catch (RouteNotFoundException $e) {
            http_response_code(404);

            echo \App\View::make('errors/error404_view');
        }
    }
}