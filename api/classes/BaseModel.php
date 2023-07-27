<?php

abstract class BaseModel extends QueryBuilder implements ModelInterface
{
      public static $tableS = '';

      protected $parentAttributes = array(
            array( 'db_name' => 'id',           'api_name' => 'id',       'required' => false, 'type' => 'i'),
            array( 'db_name' => 'created_at',   'api_name' => 'created',  'required' => false, 'type' => 's'),
            array( 'db_name' => 'updated_at',   'api_name' => 'updated',  'required' => false, 'type' => 's'),
      );
      protected $attributes;

      private static function filters(array $filters) {
            $where = false;
            $sql = "SELECT * FROM `".static::$tableS."` ";

            foreach ($filters as $filter) {
                  $w = ($where ? "AND WHERE " : "WHERE ");
                  $key = $filter[0];
                  $operator = $filter[1];
                  $value = (strtoupper($operator) == 'LIKE') ? '%'.$filter[2].'%' : $filter[2];
                  
                  $sql .= $w."`$key` ".$operator." ".$value;
            }
            return $sql;
      }

      public function getParsedRequiredAttributes($body) {
            $final = array();
            $postBody = (array) $body;

            foreach($this->attributes as $attribute) {
                  if ( $attribute['required']) {
                        $currentAttr = isset($postBody[$attribute['api_name']]) ? $postBody[$attribute['api_name']] : '';
                        $final[$attribute['db_name']] = $currentAttr;
                  }
            }

            return $final;
      }
      

      public function getParsedFields($body) {
            $final = array();
            $postBody = (array) $body;

            foreach($this->attributes as $attribute) {
                  $currentAttr = isset($postBody[$attribute['api_name']]) ? $postBody[$attribute['api_name']] : '';
                  $final[$attribute['db_name']] = $currentAttr;
            }

            return $final;
      }

      public function emptiesRequiredDatas($body) {
            $required = $this->getParsedRequiredAttributes($body);
            $missingDatas = array();

            foreach ($required as $key => $_) {
                  if (empty($required[$key])) {
                        $missingDatas[] = $key;
                  }
            }

            return count($missingDatas) > 0 ? (implode(', ', $missingDatas)) : [];
      }

      public function getAttr() {
            return $this->attributes;
      }

      public static function find($id) {
            $sql = "SELECT * FROM `".static::$tableS."` WHERE `id` = $id";
            return Db::getInstance()->getRow($sql);
      }

      public static function findAll() {
            $sql = "SELECT * FROM `".static::$tableS."`";
            return Db::getInstance()->query($sql);
      }
      
      public static function findBy(array $filters) {
            $sql = self::filters($filters);
            return Db::getInstance()->query($sql);
      }
      
      public static function findOneBy(array $filters) {
            $sql = self::filters($filters);
            return Db::getInstance()->getRow($sql);
      }
      
      public static function create($data) {
          
      }
      
      public static function update($data) {
          
      }
      
      public static function delete($id) {
          
      }

      public static function query(string $sql) {
            return Db::getInstance()->query($sql);
      }
      
}
