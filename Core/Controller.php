<?php

namespace Core;

use Core\View;
use Models\User;
use Services\AuthService;

abstract class Controller
{
    protected array $route;
    public View $view;
    protected Model $model;
    protected AuthService $authService;

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->view = new View($route);
        $this->authService = new AuthService();
        $this->setLayout();
    }

    protected function setLayout(): void
    {
        $this->view->setLayout('default');
    }

    protected function existenceUser(string $page): void
    {
        $user = new User();
        if (empty($user->findAll())) {
            $this->view->redirect($page);
        }
    }

    protected function checkAuth(): void
    {
        if(!$this->authService->checkAuth()) {
            $this->view->redirect('login');
        }
    }
}
