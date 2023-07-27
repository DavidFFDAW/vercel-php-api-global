<?php

class BlogController extends BaseController
{

      public function getBlogPosts() {
            $blogPosts = Blog::findAll();
            return $this->response($blogPosts, "posts", 200);
      }
      
      public function getSingleBlogPost(Request $request) {
            $id = $this->getTheRequestID($request);
            $singlePost = Blog::find($id);

            if (empty($singlePost)) throw new ApiException('Impossible to retrieve a blog post with this ID');

            return $this->response($singlePost, "post", 200);
      }
}
