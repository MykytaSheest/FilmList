<?php

namespace Core;

use Core\View;
use Models\User;

abstract class Controller
{
    protected array $route;
    public View $view;
    protected Model $model;

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

    protected function existenceUser()
    {
        $user = new User();
        if (empty($user->findAll())) {
            $this->view->redirect('register');
        }
    }
}
