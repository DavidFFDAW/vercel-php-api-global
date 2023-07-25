<?php

abstract class BaseModel extends QueryBuilder implements ModelInterface
{
      public static $tableS = '';

      public static function find($id) {
            $sql = "SELECT * FROM `".static::$tableS."` WHERE `id` = $id";
            return Db::getInstance()->getRow($sql);
      }

      public static function findAll() {
            $sql = "SELECT * FROM `".static::$tableS."`";
            return Db::getInstance()->query($sql);
      }
      
      public static function findBy(array $filters) {
            $where = false;
            $sql = "SELECT * FROM `".static::$tableS."` ";

            foreach ($filters as $filter) {
                  $w = ($where ? "AND WHERE " : "WHERE ");
                  $key = $filter[0];
                  $operator = $filter[1];
                  $value = (strtoupper($operator) == 'LIKE') ? '%'.$filter[2].'%' : $filter[2];
                  
                  $sql .= $w."`$key` ".$operator." ".$value;
            }

            echo $sql;

            return Db::getInstance()->query($sql);
      }
      
      public static function findOneBy(array $filters) {
          
      }
      
      public static function create($data) {
          
      }
      
      public static function update($data) {
          
      }
      
      public static function delete($id) {
          
      }
      
}
