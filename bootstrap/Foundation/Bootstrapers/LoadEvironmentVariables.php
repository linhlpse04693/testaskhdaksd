<?php

namespace Bootstrap\Foundation\Bootstrappers;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

class LoadEvironmentVariables extends Bootstraper
{
    public function boot(): void
    {
        try {
            $env = Dotenv::createImmutable(base_path());
            $env->load();
        } catch (InvalidPathException $e) {}
    }
}