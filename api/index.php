<?php
error_reporting(E_ALL & ~E_NOTICE);
define('DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('API', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// require_once(API . "Autoload.php");

// Autoload::register();

spl_autoload_register(function ($class) {
      $controllerDirectory = API . "controllers" . DIRECTORY_SEPARATOR . "$class.php";
      $classDirectory = API . "classes" . DIRECTORY_SEPARATOR . "$class.php";
      $routesDirectory = API . "routes" . DIRECTORY_SEPARATOR . "$class.php";
      $utilsDirectory = API . "utils" . DIRECTORY_SEPARATOR . "$class.php";
      $servicesDirectory = API . "services" . DIRECTORY_SEPARATOR . "$class.php";
      $databaseDirectory = API . "database" . DIRECTORY_SEPARATOR . "$class.php";
      $middlewareDirectory = API . "middlewares" . DIRECTORY_SEPARATOR . "$class.php";

      if (file_exists($controllerDirectory)) require_once($controllerDirectory);
      if (file_exists($classDirectory)) require_once($classDirectory);
      if (file_exists($routesDirectory)) require_once($routesDirectory);
      if (file_exists($utilsDirectory)) require_once($utilsDirectory);
      if (file_exists($servicesDirectory)) require_once($servicesDirectory);
      if (file_exists($databaseDirectory)) require_once($databaseDirectory);
      if (file_exists($middlewareDirectory)) require_once($middlewareDirectory);
});

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
