<?php

Routes::get('/api', BlogController::class, 'getBlogPosts');
Routes::get('/api/blog/all', BlogController::class, 'getBlogPosts');
Routes::get('/api/blog/single/post/{id}', BlogController::class, 'getSingleBlogPost');
