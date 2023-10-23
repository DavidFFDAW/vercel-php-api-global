<?php

class DocController extends BaseController
{
    public function getDocs()
    {
        return readfile(API . 'documentation/index.html');
    }
}
