<?php

class Remember
{
    public static function generateToken(): array
    {
        $selector = bin2hex(random_bytes(16));
        $validator = bin2hex(random_bytes(32));

        return [$selector, $validator, $selector . ':' . $validator];
    }

    public static function parseToken(string $token): ?array
    {
        $parts = explode(':', $token);

        if ($parts && count($parts) == 2) {
            return [$parts[0], $parts[1]];
        }

        return null;
    }

    public static function setCookie($name, $value, $expires)
    {
        setcookie($name, $value, $expires);
    }
}
