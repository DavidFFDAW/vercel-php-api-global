<?php

class DocController extends BaseController
{
    public function getDocs()
    {
        ob_start();
        require_once(API . 'documentation/index.html');
        ob_end_flush();
    }
}
