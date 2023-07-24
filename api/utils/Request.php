<?php
class Request
{
      public $request;
      public $method;
      public $requestUri;
      public $endpoint;
      public $params;
      public $body;
      public $headers;
      public $files;
      public $cookies;

      public function __construct()
      {
            $getContent = file_get_contents('php://input');
            $hasPOST = isset($_POST) && !empty($_POST);

            $this->request = $_REQUEST;
            $this->method = strtoupper(trim($_SERVER['REQUEST_METHOD']));
            $this->requestUri = $_SERVER['REQUEST_URI'];
            $this->params = (object) $_GET;
            $this->body = $hasPOST ? (object) $_POST : (object) json_decode($getContent);
            $this->headers = getallheaders();
            $this->files = $_FILES;
            $this->cookies = $_COOKIE;
      }

      public function bearerToken()
      {
            $token = $this->headers['Authorization'];
            $token = str_replace('Bearer', '', $token);
            return trim($token);
      }

      public function getAllData()
      {
            return array(
                  'request' => $this->request,
                  'method' => $this->method,
                  'requestUri' => $this->requestUri,
                  'params' => $this->params,
                  'body' => $this->body,
                  'headers' => $this->headers,
                  'files' => $this->files,
                  'cookies' => $this->cookies
            );
      }
}
