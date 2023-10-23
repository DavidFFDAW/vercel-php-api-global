<?php

class DocController extends BaseController
{
    public function getDocs()
    {
        // header('Location: ' . API . 'documentation/index.html');
        header('Content-Type: text/html');
        return include(API . 'documentation/index.html');
    }
}
