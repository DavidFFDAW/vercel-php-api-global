<?php

class User extends BaseModel
{

    public $table = 'users';
    public static $tableS = 'users';

    public static function getUserByToken(string $token)
    {
        $user = self::findOneBy([array('api_token', '=', "$token")]);

        if (empty($user)) throw new ApiException("No user found with this token");

        return $user;
    }
}
