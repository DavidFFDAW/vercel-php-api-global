<?php

interface ModelInterface {
    public static function find($id);
    public static function findAll();
    public static function findBy(array $filters);
    public static function findOneBy(array $filters);
    public static function create($data);
    public static function update($data);
    public static function delete($id);
    public function emptiesRequiredDatas($body);
}