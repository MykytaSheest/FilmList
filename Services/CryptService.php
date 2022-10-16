<?php

namespace Services;

trait CryptService
{
    private string $salt = "5uTqJmjDZJ1GftMeTe2N";

    public function crypt(string $string): string
    {
        return crypt($string, $this->salt);

    }

    public function checkCrypt(string $requestPassword, string $cryptPassword): bool
    {
        if (hash_equals($cryptPassword, crypt($requestPassword, $cryptPassword))) {
            return true;
        }
        return false;
    }
}
