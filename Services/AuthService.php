<?php

namespace Services;

use Models\User;

class AuthService
{
    use CryptService;

    private User $user;

    public function __construct()
    {
        $this->user =  new User();
    }

    public function createUser(string $email, string $password): User
    {
        $this->user->email = $email;
        $this->user->password = $this->crypt($password);
        $this->user->create();
        return $this->user;
    }

    public function loginUser(string $email, string $password)
    {
        $user = $this->user->getUserByEmail($email);
        if (isset($user)) {
            if ($this->checkCrypt($password, $user->password)) {
                $user->token = $this->crypt($email);
                return $user;
            }
            return null;
        }
        return null;
    }
}
