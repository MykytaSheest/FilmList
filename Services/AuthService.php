<?php

namespace Services;

use Core\View;
use Models\User;

class AuthService
{
    use CryptService;

    private User $user;

    public function __construct()
    {
        $this->user =  new User();
    }

    public function createUser(string $email, string $password): ?User
    {
        if ($this->user->getUserBy('email', $email)) {
            return $this->user->getUserBy('email', $email);
        }
        $this->user->email = $email;
        $this->user->password = $this->crypt($password);
        $this->user->create();
        return $this->user;
    }

    public function loginUser(string $email, string $password): ?User
    {
        $user = $this->user->getUserBy('email', $email);
        if (isset($user)) {
            if ($this->checkCrypt($password, $user->password)) {
                $user->token = $this->crypt($email);
                return $user;
            }
            return null;
        }
        return null;
    }

    public function checkAuth(): ?bool
    {
        if ($_SESSION) {
            $data = $this->user->getUserBy('id', $_SESSION['id']);
            return $this->checkCrypt($data->email, $_SESSION['token']);
        }
        return null;
    }
}
