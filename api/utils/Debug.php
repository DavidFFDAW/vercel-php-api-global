<?php

class Debug
{
    public static function dd($vars, $exit = true)
    {
        print_r("<pre>" . print_r($vars, true) . "</pre>");
        if ($exit) die();
    }

    public static function ddAPI($vars, $exit = true)
    {
        echo json_encode($vars);
        if ($exit) die();
    }
}
