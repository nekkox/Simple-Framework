<?php

namespace App;

use App\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Container implements ContainerInterface
{
    protected array $entries = [];

    //$concrete argument is a factory that is responsible for creating the object of whatever class
    // it is you want to get from the container
    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;

    }
    public function get(string $id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException('Class "' . $id . '" does not exist');
        }

        $entry = $this->entries[$id];

        //passing container instance as an argument callback, so the callback function has access to container instance
        //so you can get its own dependencies if needed within that callback
        return $entry($this);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }
}