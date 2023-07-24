<?php
$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
spl_autoload_register(function ($class) {
      global $dir;
      $classDirectory = $dir . "classes" . DIRECTORY_SEPARATOR . "$class.php";
      $controllerDirectory = $dir . "controllers" . DIRECTORY_SEPARATOR . "$class.php";
      $routesDirectory = $dir . "routes" . DIRECTORY_SEPARATOR . "$class.php";
      $utilsDirectory = $dir . "utils" . DIRECTORY_SEPARATOR . "$class.php";
      $servicesDirectory = $dir . "services" . DIRECTORY_SEPARATOR . "$class.php";

      if (file_exists($classDirectory)) require_once($classDirectory);
      if (file_exists($controllerDirectory)) require_once($controllerDirectory);
      if (file_exists($routesDirectory)) require_once($routesDirectory);
      if (file_exists($utilsDirectory)) require_once($utilsDirectory);
      if (file_exists($servicesDirectory)) require_once($servicesDirectory);
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

$envs = Env::getEnvVars();
$request = new Request();
$debug = $request->getAllData();

require_once($dir . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'index.php');

try {

      $dispatcher = new RoutesDispatcher();
      $dispatcher->dispatch(Routes::getRoutes(), $request);
} catch (ApiException $e) {
      die(Errors::getErrorObject($e, 'ApiException'));
} catch (Error $err) {
      die(Errors::getErrorObject($err, 'Error'));
} catch (Exception $exception) {
      die(Errors::getErrorObject($exception, 'Exception'));
}

print_r(
      '<pre>' .
            print_r($debug, true)
            . '</pre>'
);
