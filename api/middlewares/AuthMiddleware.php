<?php
    
class AuthMiddleware implements ItMiddleware {
    public function execute(Request $req)
    {
        $token = $req->bearerToken();
        
        if (empty($token)) throw new ApiException("Token is not correct");

        // validate token with whatever it is using for validation
    }
}