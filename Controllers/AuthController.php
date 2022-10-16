<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use http\Client\Response;
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
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->view->render('login');
                break;
            case 'POST':
                $user = $this->authService->loginUser($_POST['email'], $_POST['password']);
                if ($user) {
                    $data = [
                        "id" => $user->getId(),
                        "token" => $user->token,
                    ];

                    header('Content-Type: application/json; charset=utf-8');
                    echo json_encode($data);
                    die();
                }
                break;
            default:
                View::error(Codes::HTTP_METHOD_NOT_ALLOWED, Messages::METHOD_NOT_ALLOWED);
        }
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
