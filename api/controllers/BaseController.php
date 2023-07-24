<?php

abstract class BaseController
{
      protected function response(mixed $data, string $key = '', int $code = 200)
      {
            $realKey = empty($key) ? 'data' : $key;
            $r = array(
                  'code' => $code,
                  $realKey => $data,
            );

            http_response_code($code);
            return json_encode($r, JSON_PRETTY_PRINT);
      }
}
