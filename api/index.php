<?php

print_r(
      '<pre>' .
            print_r(array(
                  'GET' => $_GET,
                  'POST' => $_POST,
                  'REQUEST' => $_REQUEST,
                  'SERVER' => $_SERVER,
                  'FILE' => $_FILE,
            ), true)
            . '</pre>'
);
