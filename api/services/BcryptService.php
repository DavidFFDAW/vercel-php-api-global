<?php

class BcryptService
{

    public static function generate(string $pwd)
    {
        return password_hash($pwd, PASSWORD_BCRYPT);
    }

    public static function verify($pwd, $hash)
    {
        return password_verify($pwd, $hash);
    }
}
