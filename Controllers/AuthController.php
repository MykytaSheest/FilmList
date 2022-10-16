<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use lib\Codes;
use lib\Messages;
use Models\User;

class AuthController extends Controller
{

    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->model = new User();
    }

    public function login(): void
    {
        if ($this->authService->checkAuth()) {
            $this->view->redirect('/');
        }
        $this->existenceUser('register');
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->view->render('login');
                break;
            case 'POST':
                $user = $this->authService->loginUser($_POST['email'], $_POST['password']);
                if ($user) {
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['token'] = $user->token;
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
        if ($this->authService->checkAuth()) {
            $this->view->redirect('/');
        }
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

    public function logout()
    {
        session_destroy();
        $this->view->redirect('/');
    }
}
