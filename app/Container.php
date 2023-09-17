<?php

namespace App;

use App\Exceptions\ContainerException;
use App\Exceptions\NotFoundException;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionClass;
use ReflectionException;

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
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            //passing container instance as an argument callback, so the callback function has access to container instance
            //so you can get its own dependencies if needed within that callback;
            return $entry($this);
        }
        //if there is no binding we call resolve method that will do the autowiring and try to resolve the class on it own
        //We are just giving thr container another chance to resolve the requested class and it will return the value
        //that we get from the resolved method
        return $this->resolve($id);

    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function resolve(string $id)
    {
        //1. Inspect the class that we are trying to get from the container
        $reflectionClass = new ReflectionClass($id);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException('Class ' . $id . ' is not instantiable');
        }
        //2. Inspect the constructor of the class
        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $id;
        }
        //3. Inspect the constructor parameters(dependencies)
        $parameters = $constructor->getParameters();
        if (!$parameters) {
            return new $id;
        }
        //4. If the constructor parameter is a class then try to resolve that class using the container (recursive step)
        //We need to check if a parameter is a class, if yes, then we need to try to resolve that using the container itself
        //We need to do this for each parameter
        $dependencies = array_map(function (\ReflectionParameter $param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) {
                throw new ContainerException('Failed to resolve class"' . $id . '"because param' . $name . 'is missing a type hint'
                );
            }
            if ($type instanceof \ReflectionUnionType){
                throw new ContainerException('Failed to resolve class"' . $id . '"because of Union type for param"' . $name . '"');
            }
            if( $type instanceof \ReflectionNamedType && !$type->isBuiltin()){
                //then we can try to resolve this class
                return $this->get($type->getName());
            }
            throw new ContainerException('Failed to resolve class"' . $id . '"because invalid param' . $name . '""');

        },
            $parameters
        );
        return $reflectionClass->newInstanceArgs($dependencies);
    }
}