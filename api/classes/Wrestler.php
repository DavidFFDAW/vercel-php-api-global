<?php

class Wrestler extends BaseModel
{

    public static $tableS = 'wrestler';

    protected $attributes = array(
        array('api_name' => 'name',        'db_name' => "name",            "required" =>  true,    "type" => "s"),
        array('api_name' => 'alias',       'db_name' => "alias",           "required" => false,    "type" => "s"),
        array('api_name' => 'sex',         'db_name' => "sex",             "required" =>  true,    "type" => "s"),
        array('api_name' => 'brand',       'db_name' => "brand",           "required" =>  true,    "type" => "s"),
        array('api_name' => 'status',      'db_name' => "status",          "required" =>  true,    "type" => "s"),
        array('api_name' => 'is_tag',      'db_name' => "is_tag",          "required" => false,    "type" => "i"),
        array('api_name' => 'is_champ',    'db_name' => "is_champ",        "required" => false,    "type" => "i"),
        array('api_name' => 'tw_account',  'db_name' => "twitter_acc",     "required" =>  true,    "type" => "s"),
        array('api_name' => 'tw_name',     'db_name' => "twitter_name",    "required" =>  true,    "type" => "s"),
        array('api_name' => 'finisher',    'db_name' => "finisher",        "required" =>  true,    "type" => "s"),
        array('api_name' => 'image',       'db_name' => "image_name",      "required" => false,    "type" => "s"),
        array('api_name' => 'kayfabe',     'db_name' => "kayfabe_status",  "required" =>  true,    "type" => "s"),
        array('api_name' => 'tw_image',    'db_name' => "twitter_image",   "required" => false,    "type" => "s"),
        array('api_name' => 'overall',     'db_name' => "overall",         "required" =>  true,    "type" => "i"),
        array('api_name' => 'category',    'db_name' => "categories",      "required" => false,    "type" => "s"),
    );
}
