<?php

$request = Request::getInstance();
$router = new Router($request);
$common = "/api/2k";

/* BLOG ROUTES */
$router->get("$common/blog/all", BlogController::class, 'getBlogPosts');
$router->get("$common/blog/single/post/{id}", BlogController::class, 'getSingleBlogPost');

/* AUTH/USER ROUTES */
$router->post("$common/auth/login", UserController::class, 'login');
