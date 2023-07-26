<?php

class BlogController extends BaseController
{
      public function test(Request $request)
      {
            $blog = Blog::findBy([
                  array('id', '=', 9 )
            ]);

            return $this->response($blog, 'blog', 200);
      }

      public function getBlogPosts(Request $request) {
            return $this->response("Listado de todos los posts", "posts", 200);
      }
      
      public function getSingleBlogPost(Request $request) {
            return $this->response("El post con id ". $request->params->id, "post", 200);
      }
}
