<?php

class Wrestler extends BaseModel
{

    public static $tableS = 'wrestler';
    public $_table = 'wrestler';
    protected $attributes = array();

    public function __construct()
    {
        $this->attributes = array(
            'id' => new Field('id',           'id',        false, 'i'),
            'name' => new Field('name',           'name',        true, 's'),
            'alias' => new Field('alias',          'alias',      false, 's'),
            'sex' => new Field('sex',            'sex',         true, 's'),
            'brand' => new Field('brand',          'brand',       true, 's'),
            'status' => new Field('status',         'status',      true, 's'),
            'is_tag' => new Field('is_tag',         'is_tag',     false, 'i'),
            'is_champ' => new Field('is_champ',       'is_champ',   false, 'i'),
            'tw_account' => new Field('twitter_acc',    'tw_account',  true, 's'),
            'tw_name' => new Field('twitter_name',   'tw_name',     true, 's'),
            'finisher' => new Field('finisher',       'finisher',    true, 's'),
            'image' => new Field('image_name',     'image',      false, 's'),
            'kayfabe' => new Field('kayfabe_status', 'kayfabe',     true, 's'),
            'tw_image' => new Field('twitter_image',  'tw_image',   false, 's'),
            'overall' => new Field('overall',        'overall',     true, 'i'),
            'category' => new Field('categories',     'category',   false, 's'),
        );
    }
}
