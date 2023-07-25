<?php

class BlogController extends BaseController
{
      public function test()
      {
            $blog = Blog::findBy([
                  array('id', '=', 9 )
            ]);
            die($this->response($blog, 'blog', 200));
      }
}
