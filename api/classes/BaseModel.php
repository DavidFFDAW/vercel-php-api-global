<?php

abstract class BaseModel extends QueryBuilder implements ModelInterface
{
      public static $tableS = '';

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

      public static function create($data)
      {
      }

      public static function update($data)
      {
      }

      public static function delete($id)
      {
      }

      public static function query(string $sql)
      {
            return Db::getInstance()->query($sql);
      }
}
