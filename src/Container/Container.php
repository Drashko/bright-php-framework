<?php

namespace src\Container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use src\Container\Exception\ContainerException;
use src\Exception\NotFoundException;

class Container implements ContainerInterface
{

    private array $entries = [];

    /**
     * @param string $id
     * @return mixed
     */
    public function get(string $id): mixed
    {
        if($this->has($id)){
            $entry = $this->entries[$id];
            if(is_callable($entry)){
                return $entry($this);
            }
            $id = $entry;
        }
        return $this->resolve($id);
    }
    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    /**
     * @param string $id
     * @param callable|string $concrete
     */
    public function set(string $id , callable | string  $concrete) {
        $this->entries[$id] = $concrete;
    }

    /**
     * @throws ReflectionException
     * @throws ContainerException
     * @throws NotFoundException
     */
    public function resolve(string $id){
        $reflectionClass = new \ReflectionClass($id);
        if(!$reflectionClass->isInstantiable()){
            throw new ContainerException('Class "' . $id . '" is not instantiable');
        }
        $constructor = $reflectionClass->getConstructor();
        if(! $constructor){
            return new $id;
        }
        $parameters = $constructor->getParameters();
        if(! $parameters){
            return new $id;
        }
        $dependencies = array_map(
            function(\ReflectionParameter $param) use ($id){
                $name = $param->getName();
                $type = $param->getType();
                if(!$type){
                    throw new ContainerException('Cannot resolve class"' . $id . '" the param is missing a type hint' );
                }
                if($type instanceof \ReflectionUnionType){
                    throw new ContainerException('Cannot resolve class"' . $id . '" because of the union type for param '. $name);
                }
                if($type instanceof \ReflectionNamedType && !$type->isBuiltin()){
                    return $this->get($type->getName());
                }

                throw new ContainerException('Could not resolve "' .$id. '" because invalid parma' . $param);

            },
            $parameters
        );

        return $reflectionClass->newInstanceArgs($dependencies);
    }
}