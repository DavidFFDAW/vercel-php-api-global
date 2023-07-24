<?php

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

try {
      $envs = Env::getEnvVars();
      $request = new Request();
      $debug = $request->getAllData();
} catch (\Exception $e) {
      json_encode(array(
            'code' => 500,
            'error' => $e->getMessage(),
            'message' => $e->getMessage(),
      ), JSON_PRETTY_PRINT);
}

print_r(
      '<pre>' .
            print_r($debug, true)
            . '</pre>'
);
