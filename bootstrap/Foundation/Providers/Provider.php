<?php

namespace Bootstrap\Foundation\Bootstrappers;

use Bootstrap\Foundation\Application;
use Psr\Container\ContainerInterface;

abstract class Provider
{
    protected ContainerInterface $container;

    final public function __construct(protected Application &$app)
    {
        $this->container = $this->app->getContainer();
    }

    public function bind($key, callable $resolvable)
    {
        $this->container->set($key, $resolvable);
    }

    public function resolve($key)
    {
        return $this->container->get($key);
    }

    final public static function setup(&$app, array $providers)
    {
        $run_when_exists = fn($provider, $method) => method_exists($provider, $method)
            ? $provider->$method()
            : null;

        collect($providers)
            ->map(fn($provider) => new $provider($app))
            ->each(fn(Provider $provider) => $run_when_exists($provider, 'register'))
            ->each(fn(Provider $provider) => $run_when_exists($provider, 'boot'));
    }
}