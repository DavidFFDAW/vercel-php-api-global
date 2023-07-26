<?php

class Debug {
    public static function dd($vars, $exit = true) {
        if ($exit) {
            print_r("<pre>".print_r($vars, true)."</pre>");
            die();
        }
        print_r("<pre>".print_r($vars, true)."</pre>");
    }
}