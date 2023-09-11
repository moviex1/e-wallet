<?php

namespace App\Helpers;

class Router
{
    private array $routes;

    public function __construct(readonly private Container $container)
    {
    }

    public function addRoute(string $requestMethod, string $uri, array $controller): void
    {
        $route = $this->getRoute($uri);
        $this->routes[$requestMethod][$route] = $controller;
    }

    public function resolve(string $uri, string $requestMethod): void
    {
        $route = $this->getRoute($uri);
        $requestMethod = strtolower($requestMethod);
        if (isset($this->routes[$requestMethod][$route])) {
            $controller = $this->routes[$requestMethod][$route];
            $method = $controller[1];
            $controller = $this->container->get($controller[0]);
            echo call_user_func_array([$controller, $method], []);
        } else {
            http_response_code(404);
            echo 'Not Found';
        }
    }

    private function getRoute(string $uri)
    {
        return explode('?', $uri)[0];
    }

}