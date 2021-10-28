<?php

namespace App\Providers;

use Bootstrap\Foundation\DB;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $dbConfig = config('database');
        $database = new DB(...$dbConfig);
        var_dump($database); die;

        $this->bind(DB::class, fn() => $database);
    }

    public function boot()
    {
        // TODO: Implement boot() method.
    }
}