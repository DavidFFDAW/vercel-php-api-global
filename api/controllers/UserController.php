<?php

class UserController extends BaseController
{
    public function login(Request $req)
    {
        $body = $req->body;

        if (empty($body->email)) throw new ApiException("Email was not present in request");

        $foundUser = User::findOneBy([array('email', '=', "'" . $body->email . "'")]);
        if (!$foundUser || empty($foundUser)) throw new ApiException("User was not found with this email");
        $isCorrect = PasswordService::verify($body->password, $foundUser['password']);

        if (!$isCorrect) throw new ApiException("Password or email are incorrect");
        unset($foundUser['password']);

        return $this->response($foundUser, "user", 200);
    }
}
