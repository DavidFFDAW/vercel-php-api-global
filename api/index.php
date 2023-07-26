<?php
$dir = dirname(__FILE__) . DIRECTORY_SEPARATOR;
define('API', $dir);

spl_autoload_register(function ($class) {
      $classDirectory = API . "classes" . DIRECTORY_SEPARATOR . "$class.php";
      $controllerDirectory = API . "controllers" . DIRECTORY_SEPARATOR . "$class.php";
      $routesDirectory = API . "routes" . DIRECTORY_SEPARATOR . "$class.php";
      $utilsDirectory = API . "utils" . DIRECTORY_SEPARATOR . "$class.php";
      $servicesDirectory = API . "services" . DIRECTORY_SEPARATOR . "$class.php";
      $databaseDirectory = API . "database" . DIRECTORY_SEPARATOR . "$class.php";
      $middlewareDirectory = API . "middlewares" . DIRECTORY_SEPARATOR . "$class.php";

      if (file_exists($classDirectory)) require_once($classDirectory);
      if (file_exists($controllerDirectory)) require_once($controllerDirectory);
      if (file_exists($routesDirectory)) require_once($routesDirectory);
      if (file_exists($utilsDirectory)) require_once($utilsDirectory);
      if (file_exists($servicesDirectory)) require_once($servicesDirectory);
      if (file_exists($databaseDirectory)) require_once($databaseDirectory);
      if (file_exists($middlewareDirectory)) require_once($middlewareDirectory);
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

try {
      require_once(API . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'routes.php');

      // $dispatcher = new RoutesDispatcher();
      // $dispatcher->dispatch(Routes::getRoutes(), $request);
} catch (ApiException $e) {
      die(Errors::getErrorObject($e, 'ApiException'));
} catch (Error $err) {
      die(Errors::getErrorObject($err, 'Error'));
} catch (Exception $exception) {
      die(Errors::getErrorObject($exception, 'Exception'));
}
