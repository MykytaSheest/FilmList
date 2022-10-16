<?php

namespace Services;

trait CryptService
{
    private string $salt = "5uTqJmjDZJ1GftMeTe2N";

    public function crypt(string $string): string
    {
        return crypt($string, $this->salt);

    }

    public function checkCrypt(string $requestValue, string $cryptValue): bool
    {
        if (hash_equals($cryptValue, crypt($requestValue, $cryptValue))) {
            return true;
        }
        return false;
    }
}
