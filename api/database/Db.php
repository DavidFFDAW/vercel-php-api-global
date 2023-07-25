<?php

class Db {
    private $conn;
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $env = Env::getEnvVars();
        $this->conn = new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PWD'], 'wwe_2k');
        $this->conn->set_charset('utf8');
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function query($sq) {
        $finalResult = array();
        $result = $this->conn->query($sq);

        
        if ($result->num_rows > 0) {
            foreach ($result as $res) {
                $finalResult[] = $res;
            }
        }

        return $finalResult;
    }

    public function getRow($sql)
    {
        $sql .= " LIMIT 1";

        return $this->query($sql)[0];
    }
}