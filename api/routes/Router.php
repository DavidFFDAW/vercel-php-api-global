<?php

//index.php file

class Router
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($route, $controller, $method, array $middlewares = [])
    {
        $this->add('GET', $route, $controller, $method, $middlewares);
    }
    public function post($route, $controller, $method, array $middlewares = [])
    {
        $this->add('GET', $route, $controller, $method, $middlewares);
    }
    public function put($route, $controller, $method, array $middlewares = [])
    {
        $this->add('GET', $route, $controller, $method, $middlewares);
    }
    public function delete($route, $controller, $method, array $middlewares = [])
    {
        $this->add('GET', $route, $controller, $method, $middlewares);
    }


    private function simpleRoute($requestMethod, $route, $controller, $methodController, array $middlewares)
    {
        if (!empty($this->request->getURI())) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $this->request->getURI());
        } else {
            $reqUri = "/";
        }

        if ($reqUri == $route) {
            $this->executeRoute($requestMethod, $controller, $methodController, $middlewares);
            exit();
        }
    }

    private function add($requestMethod, $route, $controller, $methodController, array $middlewares = [])
    {
        $params = [];
        $paramKey = [];

        preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);

        if (empty($paramMatches[0])) {
            $this->simpleRoute($requestMethod, $route, $controller, $methodController, $middlewares);
            return;
        }

        foreach ($paramMatches[0] as $key) {
            $paramKey[] = $key;
        }

        if (!empty($this->request->getURI())) {
            $route = preg_replace("/(^\/)|(\/$)/", "", $route);
            $reqUri =  preg_replace("/(^\/)|(\/$)/", "", $this->request->getURI());
        } else {
            $reqUri = "/";
        }

        $uri = explode("/", $route);
        $indexNum = [];
        foreach ($uri as $index => $param) {
            if (preg_match("/{.*}/", $param)) {
                $indexNum[] = $index;
            }
        }
        $reqUri = explode("/", $reqUri);
        foreach ($indexNum as $key => $index) {
            if (empty($reqUri[$index])) {
                return;
            }
            $params[$paramKey[$key]] = $reqUri[$index];
            $reqUri[$index] = "{.*}";
        }

        $reqUri = implode("/", $reqUri);
        $reqUri = str_replace("/", '\\/', $reqUri);

        if (preg_match("/$reqUri/", $route)) {
            $this->request->setParameters($params);
            $this->executeRoute($requestMethod, $controller, $methodController, $middlewares);
            exit();
        }
    }

    private function executeRoute($requestMethod, $Controller, $methodController, array $middlewares)
    {
        $_requestM = $this->request->method;

        if ($requestMethod === $_requestM) {
            if (empty($Controller) || empty($methodController)) {
                throw new ApiException("Controller or method are not specified correctly");
            }
        }
        if (!empty($middlewares)) {
            foreach ($middlewares as $Middleware) {
                $middleware = new $Middleware();
                $middleware->execute($this->request);
            }
        }
        $controller = new $Controller();
        if (!method_exists($controller, $methodController)) throw new Error("Controller $controller: $methodController does not exist in this controller");

        die($controller->$methodController($this->request));
    }
}
