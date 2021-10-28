<?php

namespace Bootstrap\Foundation;

class Router
{
    protected array $routes = [];

    public function get(string $path, mixed $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {

    }
}