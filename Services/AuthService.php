<?php

namespace Services;

use Models\User;

class AuthService
{
    private string $salt = "5uTqJmjDZJ1GftMeTe2N";

    public function createUser(string $email, string $password): User
    {
        $user = new User();
        $user->email = $email;
        $user->password = $this->cryptPassword($password);
        $user->create();
        return $user;
    }

    private function cryptPassword(string $password): string
    {
        return crypt($password, $this->salt);

    }

    private function checkPassword(string $requestPassword, string $cryptPassword): mixed
    {
        if (hash_equals($cryptPassword, crypt($requestPassword, $cryptPassword))) {
            return true;
        }
        return false;
    }
}
