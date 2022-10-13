<?php

namespace Core;

use lib\Messages;

class Router
{
    protected array $routes = [];
    protected array $params = [];
    protected string $controllersDirectory = 'Controllers\\';

    public function __construct()
    {
        $routesArray = require 'Configs/routes.php';
        foreach ($routesArray as $key => $value) {
            $this->add($key, $value);
        }
        $this->run();
    }

    public function add(string $route, array $value): void
    {
        $route = "#^" . $route . "$#";
        $this->routes[$route] = $value;
    }

    public function match(): bool
    {
        $currentUrl = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $value) {
            if (preg_match($route, $currentUrl, $matches)) {
                $this->params = $value;
                return true;
            }
        }
        return false;
    }

    public function run(): void
    {
        if ($this->match()) {
            $currentControllerPath = $this->controllersDirectory .
                ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($currentControllerPath)) {
                $param = $this->params['action'];
                if (method_exists($currentControllerPath, $param)) {
                    $controller = new $currentControllerPath($this->params);
                    $controller->$param();
                    } else {
                    echo Messages::ACTION_NOT_FOUND;
                }
            } else {
                echo Messages::CONTROLLER_NOT_FOUND;
            }
        } else {
            echo Messages::ROUTE_NOT_FOUND;
        }
    }
}
