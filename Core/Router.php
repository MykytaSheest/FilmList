<?php

namespace Core;

use lib\Messages;
use lib\Codes;

class Router
{
    protected array $routes = [];
    protected array $params = [];
    protected string $controllersDirectory = 'Controllers\\';
    protected string $currentControllerPath;

    public function __construct()
    {
        $routesArray = require 'Configs/routes.php';
        foreach ($routesArray as $key => $value) {
            $this->add($key, $value);
            if ($this->match()) {
                $this->currentControllerPath = $this->controllersDirectory .
                    ucfirst($this->params['controller']) . 'Controller.php';
                if (class_exists($this->currentControllerPath)) {
                    //
                } else {
                    //
                }
            } else {
                //
            }
        }
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
}
