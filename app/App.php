<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{
    protected Router $router;
    protected array $request;
    private static \PDO $db;

    /**
     * @param Router $router
     */
    public function __construct(Router $router, array $request)
    {
        try {
            static::$db = new \PDO(
                'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function db(): \PDO{
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