<?php

declare(strict_types=1);

namespace Bridget\Foundation\Http;

class Router
{
    protected array $routes = [];

    public function __construct(protected string $base = '', protected string $path = '') {}

    public function addRoute(string $name, string $path, array $methods): static
    {
        return $this->add(new Route($name, $path, $methods));
    }

    public function add(Route $route): static
    {
        $this->routes[$route->name] = $route;
    }
}
