<?php

class Routes
{
      private static $routes = array();

      public static function get(string $endpoint, $class, string $method, array $middlewares = [])
      {
            self::registerRoute(
                  'GET',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $middlewares,
            );
      }

      public static function post(string $endpoint, $class, string $method, array $middlewares = [])
      {
            self::registerRoute(
                  'POST',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $middlewares,
            );
      }

      public static function put(string $endpoint, $class, string $method, array $middlewares = [])
      {
            self::registerRoute(
                  'PUT',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $middlewares,
            );
      }

      public static function delete(string $endpoint, $class, string $method, array $middlewares = [])
      {
            self::registerRoute(
                  'DELETE',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $middlewares,
            );
      }

      private static function registerRoute(string $type, string $endpoint, $class, string $method, array $middlewares)
      {
            self::$routes[$type][] = array(
                  'class' => $class,
                  'endpoint' => $endpoint,
                  'method' => $method,
                  'middlewares' => $middlewares,
            );
      }

      public static function getRoutes()
      {
            return self::$routes;
      }
}
