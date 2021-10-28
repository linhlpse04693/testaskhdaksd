<?php

namespace Bootstrap\Foundation;

use ReflectionClass;

interface ContainerInterface extends \Psr\Container\ContainerInterface
{
    public function set(string $abstract, mixed $concrete = null): void;

    public function resolve(string $alias): mixed;

    public function singleton($alias):mixed;

    public function getReflector($alias): ReflectionClass;

    public function getArguments($alias, \ReflectionMethod $constructor): array;

    public function resolveInterface(ReflectionClass $reflector): mixed;

    public function configure(array $config): static;
}