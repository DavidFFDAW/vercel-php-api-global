<?php

class ApiException extends Exception
{
    public function __construct(string $message, $statusCode = 500)
    {
        parent::__construct($message, $statusCode);
    }
}
