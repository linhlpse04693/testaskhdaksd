<?php

namespace Bootstrap\Foundation;

abstract class Kernel
{
    protected array $bootstrappers = [];

    public function __construct(protected Application $app)
    {
    }

    public function bootstrapApplication(): void
    {
//        Bootstrapper::setup($this->app, $this, $this->bootstrappers);
        \Bootstrap\Foundation\Bootstrappers\Bootstrapper::setup($this->app, $this, $this->bootstrappers);
    }

    public function getKernel()
    {
        return $this;
    }

    public function getApp()
    {
        return $this->app;
    }
}