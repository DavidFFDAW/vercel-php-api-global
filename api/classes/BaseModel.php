<?php

abstract class BaseModel
{
      private $conn;
      private function __construct()
      {
            $env = Env::getEnvVars();
            $this->conn = new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PWD'], 'wwe_2k');
      }

      protected function getConnection()
      {
            return $this->conn;
      }

      protected function getRow($sql)
      {
            $sql .= " LIMIT 1";

            return $this->conn->query($sql);
      }
}
