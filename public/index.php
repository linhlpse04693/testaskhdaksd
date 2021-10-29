<?php

use Src\App\Router;

require_once dirname(__DIR__) . '/vendor/autoload.php';

Router::load(APPROOT . '/src/App/routes.php')->redirect();