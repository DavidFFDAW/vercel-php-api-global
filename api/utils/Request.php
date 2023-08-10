<?php

class Request
{
      public $request;
      public $method;
      public $URI;
      public $endpoint;
      public $params;
      public $body;
      public $headers;
      public $files;
      public $cookies;
      private $user;

      private static $instance = null;

      public static function getInstance()
      {
            if (self::$instance == null || self::$instance instanceof Request) {
                  self::$instance = new Request();
            }

            return self::$instance;
      }

      private function __construct()
      {
            $getContent = file_get_contents('php://input');
            $hasPOST = isset($_POST) && !empty($_POST);

            $this->request = $_REQUEST;
            $this->method = strtoupper(trim($_SERVER['REQUEST_METHOD']));
            $this->URI = empty($_SERVER['REQUEST_URI']) ? '/' : $_SERVER['REQUEST_URI'];
            $this->params = (object) $_GET;
            $this->body = $hasPOST ? (object) $_POST : (object) json_decode($getContent);
            $this->headers = getallheaders();
            $this->files = $_FILES;
            $this->cookies = $_COOKIE;
      }

      public function bearerToken()
      {
            $token = isset($this->headers['Authorization']) ? $this->headers['Authorization'] : '';
            $token = str_replace('Bearer', '', $token);
            return trim($token);
      }

      public function checkBodyParams(array $paramKeys)
      {
            $bodyArray = (array) $this->body;

            foreach ($paramKeys as $key) {
                  if (!isset($bodyArray[$key]) || empty($bodyArray[$key])) {
                        throw new ApiException("$key is missing on body");
                        break;
                  }
            }
      }

      public function getURI()
      {
            return $this->URI;
      }

      public function getUser()
      {
            return $this->user;
      }

      public function getRequestMethod()
      {
            return $this->method;
      }

      public function setParameters(array $params)
      {
            $this->params = (object) $params;

            return $this;
      }

      public function setUser($user)
      {
            $this->user = $user;
      }

      public function getAllData()
      {
            return array(
                  'request' => $this->request,
                  'method' => $this->method,
                  'URI' => $this->URI,
                  'params' => $this->params,
                  'body' => $this->body,
                  'headers' => $this->headers,
                  'files' => $this->files,
                  'cookies' => $this->cookies
            );
      }
}
