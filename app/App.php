<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{
    protected Router $router;
    protected array $request;
    private static DB $db;
    protected array $config;

    /**
     * @param Router $router
     */
    public function __construct(Router $router, array $request, array $config)
    {
        static::$db = new DB($config);
    }

    public static function db(): DB{
        return static::$db;
    }

    public function run()
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