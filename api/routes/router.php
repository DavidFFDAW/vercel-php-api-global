<?php

Routes::get('/api/blog/all', BlogController::class, 'getBlogPosts', false);
Routes::get('/api/blog/single/post/{id}', BlogController::class, 'getSingleBlogPost', false);
