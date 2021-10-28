<?php

namespace Bootstrap\Foundation;

use Bootstrap\Foundation\Exception\ContainerException;
use Bootstrap\Foundation\Exception\NotFoundException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class Container implements ContainerInterface
{
    protected array $entries = [];

    protected array $instances = [];

    protected array $rules = [];

    /**
     * @throws ReflectionException
     * @throws NotFoundException
     * @throws ContainerException
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            $this->set($id);
        }
        if ($this->entries[$id] instanceof \Closure || is_callable($this->entries[$id])) {
            return $this->entries[$id]($this);
        }
        if (isset($this->rules['shared']) && in_array($id, $this->rules['shared'])) {
            return $this->singleton($id);
        }

        return $this->resolve($id);
    }

    public function has($id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $abstract, mixed $concrete = null): void
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }
        $this->entries[$abstract] = $concrete;
    }

    /**
     * @throws ReflectionException
     * @throws NotFoundException
     * @throws ContainerException
     */
    public function resolve(string $alias): object
    {
        $reflector = $this->getReflector($alias);
        $constructor = $reflector->getConstructor();
        if ($reflector->isInterface()) {
            return $this->resolveInterface($reflector);
        }
        if (!$reflector->isInstantiable()) {
            throw new ContainerException(
                "Cannot inject {$reflector->getName()} to {$alias} because it cannot be instantiated"
            );
        }
        if (null === $constructor) {
            return $reflector->newInstance();
        }
        $args = $this->getArguments($alias, $constructor);
        return $reflector->newInstanceArgs($args);
    }

    public function singleton($alias): mixed
    {
        if (!isset($this->instances[$alias])) {
            $this->instances[$alias] = $this->resolve(
                $this->entries[$alias]
            );
        }
        return $this->instances[$alias];
    }

    /**
     * @throws NotFoundException
     */
    public function getReflector($alias): ReflectionClass
    {
        $class = $this->entries[$alias];
        try {
            return (new ReflectionClass($class));
        } catch (ReflectionException $e) {
            throw new NotFoundException(
                $e->getMessage(), $e->getCode()
            );
        }
    }

    /**
     * Get the constructor arguments of a class
     * @param ReflectionMethod $constructor The constructor
     * @return array The arguments
     */
    public function getArguments($alias, ReflectionMethod $constructor): array
    {
        $args = [];
        $params = $constructor->getParameters();
        foreach ($params as $param) {
            if (null !== $param->getType()) {
                $args[] = $this->get(
                    $param->getType()->getName()
                );
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();
            } elseif (isset($this->rules[$alias][$param->getName()])) {
                $args[] = $this->rules[$alias][$param->getName()];
            }
        }
        return $args;
    }

    /**
     * @throws ReflectionException
     * @throws NotFoundException
     */
    public function resolveInterface(ReflectionClass $reflector): mixed
    {
        if (isset($this->rules['substitute'][$reflector->getName()])) {
            return $this->get(
                $this->rules['substitute'][$reflector->getName()]
            );
        }

        $classes = get_declared_classes();
        foreach ($classes as $class) {
            $rf = new ReflectionClass($class);
            if ($rf->implementsInterface($reflector->getName())) {
                return $this->get($rf->getName());
            }
        }
        throw new NotFoundException(
            "Class {$reflector->getName()} not found", 1
        );
    }

    public function configure(array $config): static
    {
        $this->rules = array_merge($this->rules, $config);

        return $this;
    }
}