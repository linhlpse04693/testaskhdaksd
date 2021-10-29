<?php

// Routes in main controllers/ folder (Namespace \Controllers)
$router->addRoute('songs', ['controller' => 'Song', 'action' => 'all', 'method' => 'GET']);
$router->addRoute('songs', ['controller' => 'Song', 'action' => 'store', 'method' => 'POST']);
$router->addRoute('songs/{id:\d+}', ['controller' => 'Song', 'action' => 'get', 'method' => 'GET']);
$router->addRoute('songs/{id:\d+}', ['controller' => 'Song', 'action' => 'delete', 'method' => 'DELETE']);
$router->addRoute('songs/{id:\d+}', ['controller' => 'Song', 'action' => 'Update', 'method' => 'PUT']);

$router->addRoute('movies', ['controller' => 'Movie', 'action' => 'all', 'method' => 'GET']);
$router->addRoute('movies', ['controller' => 'Movie', 'action' => 'store', 'method' => 'POST']);
$router->addRoute('movies/{id:\d+}', ['controller' => 'Movie', 'action' => 'get', 'method' => 'GET']);
$router->addRoute('movies/{id:\d+}', ['controller' => 'Movie', 'action' => 'delete', 'method' => 'DELETE']);
$router->addRoute('movies/{id:\d+}', ['controller' => 'Movie', 'action' => 'Update', 'method' => 'PUT']);


$router->setParams(getUri());