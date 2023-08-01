<?php

interface ModelInterface
{
    public static function find($id);
    public static function findAll();
    public static function findBy(array $filters);
    public static function findOneBy(array $filters);
    public function upsert($data);
    public static function delete($id);
    public function getRequiredAttributesParsed(array $body);
    public function getAttributesParsed($body, $key = 'db_name');
}
