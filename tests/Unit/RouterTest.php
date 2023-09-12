<?php

namespace Tests\Unit;

use App\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    //GIVEN WHEN THEN
    //Test that the route can be registered
    public function test_that_it_registers_a_route(): void
    {

        //given that we have a router object
        $router = new Router();
        //when we call a register method
        $router->register('get', '/users', ['Users', 'index']);
        //then we assert route was registered
        $expected = [
            'get' => [
                '/users' => [
                    'Users', 'index'
                ]
            ]
        ];
        $this->assertEquals($expected, $router->routes());

    }

    public function test_that_it_registers_a_route_with_callable_parameter(): void
    {
        $router = new Router();
        $router->register('get', '/users', function () {
            echo 'Hello World';
        });
        $this->assertInstanceOf('Closure', $router->routes()['get']['/users']);
    }

    public function test_that_it_registers_a_route_with_callable_function():void{
        $router = new Router();
        $router->register('get', '/users', function () {
            return 'Hello World';
        });
        $closure = $router->routes()['get']['/users'];
        $this->assertSame('Hello World', $closure());
    }



}