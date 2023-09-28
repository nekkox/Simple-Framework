<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Router;
use App\Services\EmailService;
use App\Services\InvoiceService;
use App\Services\PaddlePayment;
use App\Services\StripePayment;
use App\Services\PaymentGatewayInterface;
use App\Services\SalesTaxService;
use Symfony\Component\Mailer\MailerInterface;

class App
{
    private Router $router;
    protected array $request;
    private static DB $db;
   // public static Container $container;
    protected Config $config;




    public function __construct(
        protected Container $container, Router $router, array $request, Config $config
    ){
        $this->router = $router;
        $this->request = $request;
        $this->config = $config;
        static::$db = new DB($config->db ?? []);

/*        $this->container->set(
            PaymentGatewayInterface::class,
            fn (Container $container) => $container->get(StripePayment::class)
        );*/
        // We want to be able to bind interface in the container to concrete StripePayment class implementation
        //without passing any closures
       // var_dump(VIEW_PATH);

        $this->container->set(PaymentGatewayInterface::class, PaddlePayment::class);
        $this->container->set(MailerInterface::class, fn() => new CustomMailer($config->mailer['dsn']));
        //var_dump($this->config);

        /*static::$container = new Container();

        static::$container->set(SalesTaxService::class, fn() => new SalesTaxService());
        static::$container->set(EmailService::class, fn() => new EmailService());
        static::$container->set(StripePayment::class, fn() => new StripePayment());

        static::$container->set(InvoiceService::class, function (Container $container) {
            return new InvoiceService(
                $container->get(SalesTaxService::class),
                $container->get(EmailService::class),
                $container->get(StripePayment::class),
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