<?php

class Routes
{
      private static $routes = array();

      public static function get(string $endpoint, $class, string $method, bool $protected = false)
      {
            self::registerRoute(
                  'GET',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $protected,
            );
      }

      public static function post(string $endpoint, $class, string $method, bool $protected = false)
      {
            self::registerRoute(
                  'POST',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $protected,
            );
      }

      public static function put(string $endpoint, $class, string $method, bool $protected = false)
      {
            self::registerRoute(
                  'PUT',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $protected,
            );
      }

      public static function delete(string $endpoint, $class, string $method, bool $protected = false)
      {
            self::registerRoute(
                  'DELETE',
                  $endpoint,
                  $class,
                  (empty($method) ? 'list' : $method),
                  $protected,
            );
      }

      private static function registerRoute(string $type, string $endpoint, $class, string $method, bool $protected)
      {
            self::$routes[$type][] = array(
                  'class' => $class,
                  'endpoint' => $endpoint,
                  'method' => $method,
                  'protected' => $protected,
            );
      }

      public static function getRoutes()
      {
            return self::$routes;
      }
}
