<?php

namespace Src\App;

class Router
{
  private $routes = [];
  private $params = [];

  public static function load(string $file): Router
  {
    $router = new static;

    require_once $file;

    return $router;
  }

  public function addRoute(string $route, array $params = []): void
  {
    if(isset($params['method']) && $_SERVER['REQUEST_METHOD'] !== $params['method']){
      return;
    }

    // Escape forward slashes
    $route = preg_replace('/\//', '\\/', $route);

    // Convert variables {controller}
    $route = preg_replace('/\{([a-z0-9]+)\}/', '(?P<\1>[a-z0-9-]+)', $route);

    // Convert variables with custom regular expressions {id:\d+} for numbers
    $route = preg_replace('/\{([a-z0-9]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

    // Add start and end delimeter
    $route = '/^' . $route . '$/i';

    $this->routes[$route] = $params;
  }

  public function setParams(string $uri): void
  {
    foreach ($this->routes as $route => $params) {
      if (preg_match($route, $uri, $matches)) {
        foreach ($matches as $key => $match) {
          if (is_string($key)) {
            if ($key === 'controller') {
              $match = ucwords($match);
            }

            $params[$key] = $match;
          }
        }

        $this->params = $params;
      }
    }
  }

  public function redirect(): void
  {
    $controller = $this->getNamespace() . $this->params['controller'];
    $action = $this->capitalizeAction($this->params['action']);

    if (class_exists($controller)) {
      $controller = new $controller;
      unset($this->params['controller']);

      if (is_callable([$controller, $action])) {
        unset($this->params['action']);
        unset($this->params['namespace']);
      } else {
        header("HTTP/1.1 404 Not found");
      }
    } else {
      header("HTTP/1.1 404 Not found");
    }

    call_user_func_array([$controller, $action], [$this->params]);
  }

  private function getNamespace(): string
  {
    $namespace = '\\Src\\Controller\\';

    if (array_key_exists('namespace', $this->params)) {
      $namespace .= $this->params['namespace'] . '\\';
    }

    return $namespace;
  }

  private function capitalizeAction(string $action): string
  {
    $action = explode('-', $action);

    for ($i = 1; $i < count($action); $i++) {
      $action[$i] = ucwords($action[$i]);
    }

    return implode($action);
  }
}
