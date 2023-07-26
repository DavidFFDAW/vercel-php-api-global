<?php

class RoutesDispatcher
{
      private function matchSimpleRoute($baseRoute, Request $req) {
            $URI = $req->getURI();
            $route = preg_replace("/(^\/)|(\/$)/","",$baseRoute);
            $reqUri = empty($URI) ? '/' : preg_replace("/(^\/)|(\/$)/","",$URI);

            return $reqUri == $route;
      }

      private function convertRoute($routeObject, $baseEndpoint, Request $request) {
            $params = [];
            $paramKey = [];
            $reqUri = $baseEndpoint;
            $match = false;

            $baseRoute = $routeObject['endpoint'];
            $route = preg_replace("/(^\/)|(\/$)/","", $baseRoute);
            $endpoint = preg_replace("/(^\/)|(\/$)/", "", $baseEndpoint);
            preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

            $hasParams = !empty($paramMatches[0]);

            if (!$hasParams) return $this->matchSimpleRoute($baseRoute, $baseEndpoint, $request);

            if ($hasParams) {
                  foreach($paramMatches[0] as $key){
                        $paramKey[] = $key;
                  }
                  $uri = explode("/", $route);
                  $indexNum = []; 

                  foreach($uri as $index => $param){
                        if(preg_match("/{.*}/", $param)){
                              $indexNum[] = $index;
                        }
                  }
                  
                  $reqUri = explode("/", $endpoint);
                  
                  foreach($indexNum as $key => $index){
                        if(!empty($reqUri[$index])){
                              $params[$paramKey[$key]] = $reqUri[$index];
                              $reqUri[$index] = "{.*}";
                        }
                  }
                  $reqUri = implode("/",$reqUri);
                  
            }
            
            
            $reqUri = str_replace("/", '\\/', $reqUri);
            $match = preg_match("/$reqUri/", $route);
            
            if($match) {
                  $request->setParameters($params);
            }

            return $match;
      }

      private function searchForRoute($routes, $endpoint, Request $request)
      {
            $found = array();
            
            foreach ($routes as $route) {
                  $doRouteMatch = $this->convertRoute($route, $endpoint, $request);

                  if ($doRouteMatch) {
                        $found = $route;
                        break;
                  }
            }

            return $found;
      }

      public function dispatch(array $routes, Request $request)
      {
            $methodRoutes = $routes[$request->method];
            $uri = $request->getURI();

            if (empty($methodRoutes) || empty($uri)) throw new ApiException("There are no routes for this method and endpoint");

            $foundRoute = $this->searchForRoute($methodRoutes, $uri, $request);

            if (empty($foundRoute)) throw new ApiException("Custom Route $uri not found");

            $Controller = $foundRoute['class'];
            $controllerMethod = $foundRoute['method'];

            if (empty($Controller) || empty($controllerMethod)) {
                  throw new ApiException("Controller or method are not specified correctly");
            }

            $middlewares = $foundRoute['middlewares'];
            if (!empty($middlewares)) {
                  foreach ($middlewares as $Middleware) {
                        $middleware = new $Middleware();
                        $middleware->execute($request);
                  }
            }

            $controller = new $Controller();
            if (!method_exists($controller, $controllerMethod)) throw new Error("Controller $controller: $controllerMethod does not exist in this controller");

            die($controller->$controllerMethod($request));
      }
}
