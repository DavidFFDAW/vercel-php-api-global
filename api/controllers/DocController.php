<?php

class DocController extends BaseController
{
    public function getDocs()
    {
        $output = file_get_contents(API . 'documentation/index.html');
        echo $output;
    }
}
