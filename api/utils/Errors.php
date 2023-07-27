<?php

class Errors
{
    public static function getAPIErrorObject($e, $breakpoint = '')
    {
        return json_encode(array(
            'code' => $e->getStatusCode(),
            'message' => $e->getMessage(),
            'error' => $e->getMessage(),
            'type' => 'Server error',
            'breakpoint' => $breakpoint,
        ), JSON_PRETTY_PRINT);
    }

    public static function getErrorObject($e, $breakpoint = '')
    {
        return json_encode(array(
            'code' => 500,
            'message' => $e->getMessage(),
            'error' => $e->getMessage(),
            'type' => 'Server error',
            'breakpoint' => $breakpoint,
        ), JSON_PRETTY_PRINT);
    }
}
