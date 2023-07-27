<?php
    
class Wrestler extends BaseModel {
    
    public static $tableS = 'wrestler';
    protected $attributes;

    public function __construct()
    {
        // $this->attributes = array_merge($this->parentAttributes, array(
        $this->attributes = array(
            array( 'db_name' => 'name',           'api_name' => 'name',      'required' => true,   'type' => 's'),
            array( 'db_name' => 'alias',          'api_name' => 'alias',     'required' => true,   'type' => 's'),
            array( 'db_name' => 'sex',            'api_name' => 'gender',    'required' => true,   'type' => 's'),
            array( 'db_name' => 'brand',          'api_name' => 'brand',     'required' => true,   'type' => 's'),
            array( 'db_name' => 'status',         'api_name' => 'status',    'required' => true,   'type' => 's'),
            array( 'db_name' => 'is_tag',         'api_name' => 'tag',       'required' => false,  'type' => 'i'),
            array( 'db_name' => 'is_champ',       'api_name' => 'champ',     'required' => false,  'type' => 'i'),
            array( 'db_name' => 'twitter_acc',    'api_name' => 'tw_acc',    'required' => true,   'type' => 's'),
            array( 'db_name' => 'twitter_name',   'api_name' => 'tw_name',   'required' => true,   'type' => 's'),
            array( 'db_name' => 'finisher',       'api_name' => 'finisher',  'required' => true,   'type' => 's'),
            array( 'db_name' => 'image_name',     'api_name' => 'image',     'required' => false,  'type' => 's'),
            array( 'db_name' => 'kayfabe_status', 'api_name' => 'kayfabe',   'required' => true,   'type' => 's'),
            array( 'db_name' => 'twitter_image',  'api_name' => 'tw_image',  'required' => false,  'type' => 's'),
            array( 'db_name' => 'overall',        'api_name' => 'overall',   'required' => true,   'type' => 'i'),
            array( 'db_name' => 'categories',     'api_name' => 'category',  'required' => false,  'type' => 's'),
        );    
        // ));    
    }
}