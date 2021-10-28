<?php

namespace App\Providers;

use Bootstrap\Foundation\Bootstrappers\Provider;

abstract class ServiceProvider extends Provider
{
    abstract public function register();
    abstract public function boot();
}