<?php

$app = require_once __DIR__ . './../bootstrap/app.php';

$kernel = $app->resolve(App\Http\HttpKernel::class);

$kernel->bootstrapApplication();

$app->run();
