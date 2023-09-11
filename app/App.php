<?php

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Router;

class App
{
    private Router $router;
    protected array $request;
    private static DB $db;
    protected Config $config;


    public function __construct(Router $router, array $request, Config $config)
    {
        $this->router = $router;
        $this->request = $request;
        $this->config = $config;
        static::$db = new DB($config->db ?? []);
    }

    public static function db(): DB{
        return static::$db;
    }

    public function run():void
    {
        try {
           echo $this->router->resolve(
               $this->request['uri'],
               strtolower($this->request['method'])
           );
        }catch(RouteNotFoundException $e) {
            http_response_code(404);

            echo \App\View::make('errors/error404_view');
        }
    }
}