<?php
error_reporting(E_ALL & ~E_NOTICE);
define('DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('API', dirname(__FILE__) . DIRECTORY_SEPARATOR);

require_once(API . "Autoload.php");

Autoload::register();
Header::setHeaders();
define('DEV', $_SERVER['HTTP_HOST'] == 'localhost:8555');

try {
      require_once(API . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php');
} catch (ApiException $e) {
      die(Errors::getAPIErrorObject($e, 'ApiException'));
} catch (Error $err) {
      die(Errors::getErrorObject($err, 'Error'));
} catch (Exception $exception) {
      die(Errors::getErrorObject($exception, 'Exception'));
}
