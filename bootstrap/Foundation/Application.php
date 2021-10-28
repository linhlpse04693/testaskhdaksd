<?php

namespace Bootstrap\Foundation;

use Bootstrap\Foundation\Http\Request;

class Application
{
    protected Router $router;
    protected Request $request;
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->router = $this->get(Router::class);
    }

    public function run()
    {
        $this->router->resolve();
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    public function has(...$parameters): bool
    {
        return $this->getContainer()->has(...$parameters);
    }

    public function bind(...$parameters)
    {
        $this->getContainer()->set(...$parameters);
    }

    public function resolve(...$parameters): mixed
    {
        return $this->getContainer()->resolve(...$parameters);
    }

    public function get(...$parameters): mixed
    {
        return $this->getContainer()->get(...$parameters);
    }
}
