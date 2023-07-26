<?php

$request = Request::getInstance();
$router = new Router($request);

$router->get('/api/blog/all', BlogController::class, 'getBlogPosts');
$router->get('/api/blog/single/post/{id}', BlogController::class, 'getSingleBlogPost');
