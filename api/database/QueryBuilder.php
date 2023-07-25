<?php

class QueryBuilder {
    private $db;
    private $sentence = '';

    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function select($fields = '*') {
        $selecteds = (is_array($fields) && !empty($fields)) ? implode(',', $fields) : '*';
        $this->sentence = "SELECT $selecteds";
    }



}