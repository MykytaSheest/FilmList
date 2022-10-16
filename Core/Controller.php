<?php

namespace Core;

use Core\View;

abstract class Controller
{
    protected array $route;
    protected Model $model;
    public View $view;

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->setLayout();
    }

    protected function setLayout(): void
    {
        $this->view->setLayout('default');
    }
}
