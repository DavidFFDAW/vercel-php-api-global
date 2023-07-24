<?php

class BlogController extends BaseController
{
      public function test()
      {
            throw new ApiException('Blog test gives error');
            // die($this->response([], 'data', 200));
      }
}
