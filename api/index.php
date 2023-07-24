<?php


header('Content-type: application/json');
header('Accept: *');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
      die();
}

$envs = Env::getEnvVars();
$request = new Request();
$debug = $request->getAllData();

print_r(
      '<pre>' .
            print_r($debug, true)
            . '</pre>'
);

spl_autoload_register(function ($class) {
      $base = dirname(__FILE__) . DIRECTORY_SEPARATOR;

      $classDirectory = $base . "classes" . DIRECTORY_SEPARATOR . "$class.php";
      $controllerDirectory = $base . "controllers" . DIRECTORY_SEPARATOR . "$class.php";
      $routesDirectory = $base . "routes" . DIRECTORY_SEPARATOR . "$class.php";
      $utilsDirectory = $base . "utils" . DIRECTORY_SEPARATOR . "$class.php";

      if (file_exists($classDirectory)) require_once($classDirectory);
      if (file_exists($controllerDirectory)) require_once($controllerDirectory);
      if (file_exists($routesDirectory)) require_once($routesDirectory);
      if (file_exists($utilsDirectory)) require_once($utilsDirectory);
});
