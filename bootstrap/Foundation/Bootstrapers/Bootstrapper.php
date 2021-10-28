<?php

namespace Bootstrap\Foundation\Bootstrappers;

use Bootstrap\Foundation\Application;
use Bootstrap\Foundation\Kernel;

class Bootstrapper
{
    public function __construct(Application &$app, Kernel &$kernel)
    {
    }

    public  function setup($app, $kernel, array $bootstrappers): void
    {
        collect($bootstrappers)
            ->map(fn(Bootstrapper $bootstraper) => new $bootstraper($app, $kernel))
            ->each(fn(Bootstrapper $bootstraper) => $bootstraper->boot());
    }

    public function boot(): void
    {
    }
}