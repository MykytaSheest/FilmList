<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use lib\Codes;
use lib\Messages;
use Models\User;
use Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->model = new User();
        $this->authService = new AuthService();
    }

    public function login(): void
    {
        $this->view->render('login');
    }

    public function register(): void
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->view->render('register');
                break;
            case 'POST':
                $this->authService->createUser($_POST['email'], $_POST['password']);
                $this->view->redirect('/login');
                break;
            default:
                View::error(Codes::HTTP_METHOD_NOT_ALLOWED, Messages::METHOD_NOT_ALLOWED);
        }
    }
}
