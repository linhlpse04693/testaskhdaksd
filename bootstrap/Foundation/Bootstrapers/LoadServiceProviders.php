<?php

namespace Bootstrap\Foundation\Bootstrappers;

class LoadServiceProviders extends Bootstrapper
{
    public function boot(): void
    {
        $app = $this->app;
        $providers = config('app.providers');
        $providers = [...$providers, RouteServiceProvider::class];

        Provider::setup($app, $providers);
    }
}