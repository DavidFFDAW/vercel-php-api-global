<?php

$envs = array(
      'DB_HOST' => getenv('DB_HOST'),
      'DB_USER' => getenv('DB_USER'),
      'FTP_USER' => getenv('FTP_USER'),
);

print_r(
      '<pre>' .
            print_r(array(
                  'GET' => $_GET,
                  'POST' => $_POST,
                  'REQUEST' => $_REQUEST,
                  'SERVER' => $_SERVER,
                  'FILES' => $_FILE,
                  'ENV_VARS' => $envs,
            ), true)
            . '</pre>'
);
