<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Http\HttpKernel;
use Bootstrap\Foundation\Application;
use Bootstrap\Foundation\Container;


$container = new Container();

$app = new Application($container);

$httpKernel = new HttpKernel($app);

$boostrap = new \Bootstrap\Foundation\Bootstrappers\Bootstrapper($app, $httpKernel);

//$boostrap->setup();

$app->bind(HttpKernel::class, $httpKernel);

$_SERVER['app'] = &$app;

if (!function_exists('app')) {
    function app()
    {
        return $_SERVER['app'];
    }
}

return $app;
