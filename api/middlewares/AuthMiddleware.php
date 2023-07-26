<?php

class AuthMiddleware implements ItMiddleware
{
    public function execute(Request $req)
    {
        $token = $req->bearerToken();

        if (empty($token)) throw new ApiException("Token is empty or not correct");

        $user = User::getUserByToken($token);

        if (!empty($user) && !$user) {
            $req->setUser($user);
        }

        return boolval($user);
    }
}
