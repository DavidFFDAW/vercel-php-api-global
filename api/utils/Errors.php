<?php

class Errors
{
    public static function getAPIErrorObject($e, $breakpoint = '')
    {
        return json_encode(array(
            'code' => $e->getStatusCode(),
            'trace' => array(
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ),
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
            'trace' => array(
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack_trace' => $e->getTraceAsString(),
            ),
            'message' => $e->getMessage(),
            'error' => $e->getMessage(),
            'type' => 'Server error',
            'breakpoint' => $breakpoint,
        ), JSON_PRETTY_PRINT);
    }
}
