<?php

abstract class BaseModel extends QueryBuilder implements ModelInterface
{
      public static $tableS = '';
      public $_table = '';
      protected $attributes = array();

      private static function filters(array $filters)
      {
            $where = false;
            $db = Db::getInstance();
            $sql = "SELECT * FROM `" . static::$tableS . "` ";

            foreach ($filters as $filter) {
                  $w = ($where ? "AND WHERE " : "WHERE ");
                  $key = $db->scape($filter[0]);
                  $operator = $db->scape($filter[1]);
                  $isLike = (strtoupper($operator) == 'LIKE');
                  $value = $db->scape($isLike ? '%' . $filter[2] . '%' : $filter[2]);
                  $finalValue = gettype($value) === 'string' ? "'" . $value . "'" : $value;

                  $sql .= $w . "`$key` " . $operator . " " . ($finalValue);
            }

            return $sql;
      }

      public function getAttributesParsed($body, $key = 'db_name')
      {
            $final = array();
            $body = (array) $body;

            foreach ($this->attributes as $attribute) {
                  $apiName = $attribute->getAPIName();

                  if (isset($body[$apiName]) && !empty($body[$apiName])) {
                        $final[$apiName] = $body[$apiName];
                  }
            }

            return $final;
      }

      public function getRequiredAttributesParsed($body, $key = 'api_name')
      {
            $final = array();
            $body = (array) $body;

            foreach ($this->attributes as $attribute) {
                  if ($attribute->isRequired()) {
                        $apiName = $attribute->getAPIName();
                        $final[$apiName] = isset($body[$apiName]) ? $body[$apiName] : '';
                  }
            }

            return $final;
      }

      public static function find($id)
      {
            $db = Db::getInstance();
            $sql = "SELECT * FROM `" . static::$tableS . "` WHERE `id` = " . $db->scape($id);
            return $db->getRow($sql);
      }

      public static function findAll()
      {
            $sql = "SELECT * FROM `" . static::$tableS . "`";
            return Db::getInstance()->query($sql);
      }

      public static function findBy(array $filters)
      {
            $sql = self::filters($filters);
            return Db::getInstance()->query($sql);
      }

      public static function findOneBy(array $filters)
      {
            $sql = self::filters($filters);
            return Db::getInstance()->getRow($sql);
      }

      private function getPreparedDatas($datas, $insert = false)
      {
            $str = [];
            $types = [];
            $values = [];
            $keys = [];

            foreach ($datas as $key => $value) {
                  if (!isset($this->attributes[$key])) continue;

                  $att = $this->attributes[$key];

                  if (!$att->isID()) {
                        $insertSQ = $insert ? "?" : ("`" . $att->getDbName() . "` = ?");
                        
                        $str[] = $insertSQ;
                        $types[] = $att->getType();
                        $values[] = $value;
                        $keys[] = $att->getDbName();
                  }
            }

            return array(
                  'string' => implode(", ", $str),
                  'types' => implode("", $types),
                  'values' => $values,
                  'keys' => $keys,
            );
      }

      private function insert($datas)
      {
            $prepared = $this->getPreparedDatas($datas, true);
            $sql = "INSERT INTO `".$this->_table . "` (`".implode('`, `', $prepared['keys'])."`) VALUES (". $prepared['string'].")";

            $stmt = Db::getInstance()->prepare($sql);
            $stmt->bind_param($prepared['types'], ...$prepared['values']);
            $stmt->execute();

            $result = $stmt->get_result();
            $isInserted = !empty($stmt->insert_id);

            return array(
                  'result' => $result,
                  'upserted' => $isInserted,
            );
      }

      private function update($datas)
      {
            if (!isset($datas['id']) || empty($datas['id'])) throw new ApiException("Not id received");

            $prepared = $this->getPreparedDatas($datas);
            $sql = "UPDATE `" . $this->_table . "` SET " . $prepared['string'] . " WHERE id = ?";

            $stmt = Db::getInstance()->prepare($sql);
            $values = array(...$prepared['values'], $datas['id']);
            $stmt->bind_param($prepared['types'].'i', ...$values);
            
            $stmt->execute();

            $result = $stmt->get_result();
            $isUpdated = $stmt->affected_rows > 0;

            return array(
                  'result' => $result,
                  'upserted' => $isUpdated,
            );
      }

      public function upsert($data)
      {
            if (isset($data['id']) && !empty($data['id'])) {
                  return $this->update($data);
            }
            return $this->insert($data);
      }

      public static function delete($id)
      {
            $sql  = "DELETE FROM ". static::$tableS ." WHERE `id` = ?";
            $stmt = Db::getInstance()->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();

            return array(
                  'result' => $result,
                  'deleted' => $stmt->affected_rows > 0,
            );
      }

      public static function query(string $sql)
      {
            return Db::getInstance()->query($sql);
      }
}
