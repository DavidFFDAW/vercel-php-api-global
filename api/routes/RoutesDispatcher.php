<?php

class RoutesDispatcher
{
      private function searchForRoute($routes, $endpoint)
      {
            $found = array();

            foreach ($routes as $route) {
                  if ($route['endpoint'] === $endpoint) {
                        $found = $route;
                        break;
                  }
            }

            return $found;
      }

      public function dispatch(array $routes, Request $request)
      {
            $methodRoutes = $routes[$request->method];
            $uri = $request->requestUri;

            if (empty($methodRoutes) || empty($uri)) throw new ApiException("There are no routes for this method and endpoint");

            $foundRoute = $this->searchForRoute($methodRoutes, $uri);

            if (empty($foundRoute)) throw new ApiException("Custom Route $uri not found");

            $Controller = $foundRoute['class'];
            $controllerMethod = $foundRoute['method'];

            if (empty($Controller) || empty($controllerMethod)) {
                  throw new ApiException("Controller or method are not specified correctly");
            }

            $controller = new $Controller();
            if (!method_exists($controller, $controllerMethod)) throw new Error("Controller $controller: $controllerMethod does not exist in this controller");

            return $controller->$controllerMethod($request);
      }
}
