<?php

class RoutesDispatcher
{
      private function search($routes, $endpoint)
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

            $foundRoute = $this->search($methodRoutes, $uri);

            if (empty($foundRoute)) throw new Error("Route $uri not found");

            $Controller = $foundRoute['class'];
            $controllerMethod = $foundRoute['method'];

            if (empty($Controller) || empty($controllerMethod)) {
                  throw new Error("Controller or method are not specified correctly");
            }

            $controller = new $Controller();

            if (!method_exists($controller, $controllerMethod)) throw new Error("Controller $controller: $controllerMethod does not exist in this controller");

            return $controller->$controllerMethod($request);
      }
}
