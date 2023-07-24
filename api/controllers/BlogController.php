<?php

class BlogController extends BaseController
{
      public function test()
      {
            die($this->response([], 'data', 200));
      }
}
