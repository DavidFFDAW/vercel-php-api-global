<?php

abstract class BaseController
{
      protected function getTheRequestID(Request $req) {
            $id = isset($req->params->id) ? $req->params->id : '';
            if (!$this->isChecker($id)) throw new ApiException("No ID indicated to delete");

            return $id;
      }

      protected function isChecker($condition) {
            return isset($condition) && !empty($condition);
      }

      protected function response($data, string $key = '', int $code = 200)
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
