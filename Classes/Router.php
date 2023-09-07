<?php
namespace Classes;

use Classes\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $route, callable|array $action): self
    {
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve($requestUri)
    {
        $route = explode('?', $requestUri)[0];
        $action = $this->routes[$route] ?? null;
        var_dump($action);

        if (!$action) {
            throw new RouteNotFoundException();
        }
        if (is_callable($action)) {

            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $method] = $action; //Rozbicie tablicy $action na 2 elementy - class & method

            if (class_exists($class)) {
                $class = new $class();

                if(method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
        throw new RouteNotFoundException();
    }
}
