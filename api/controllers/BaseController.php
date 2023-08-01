<?php

abstract class BaseController
{
      protected function getTheRequestID(Request $req)
      {
            $id = isset($req->params->id) ? $req->params->id : '';
            if (!$this->isChecker($id)) throw new ApiException("No ID indicated to delete");

            return $id;
      }

      protected function isChecker($condition)
      {
            return isset($condition) && !empty($condition);
      }

      protected function getCheckedDatas(ModelInterface $model, $body)
      {
            $required = $model->getRequiredAttributesParsed((array) $body);

            $empties = array_filter($required, function ($data) {
                  return empty($data);
            });

            if (!empty($empties)) {
                  $a = implode(", ", array_keys($empties));
                  throw new ApiException("[ $a ] are required in this context");
            }

            return $model->getAttributesParsed($body);
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
