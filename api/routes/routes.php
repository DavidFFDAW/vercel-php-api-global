<?php

$request = Request::getInstance();
$router = new Router($request);
$common = "/api/2k";

/* BLOG ROUTES */
$router->get("$common/blog/all", BlogController::class, 'getBlogPosts');
$router->get("$common/blog/single/post/{id}", BlogController::class, 'getSingleBlogPost');

/* AUTH/USER ROUTES */
$router->post("$common/auth/login", UserController::class, 'login');

/* WRESTLERs ROUTES */
$router->get("$common/wrestlers/all", WrestlerController::class, 'getAll');
$router->get("$common/wrestlers/released", WrestlerController::class, 'getReleasedWrestlers');
$router->get("$common/wrestlers/active", WrestlerController::class, 'getActiveWrestlers');
$router->get("$common/wrestlers/single/{id}", WrestlerController::class, 'getSingleWrestler');
$router->post("$common/wrestlers/upsert", WrestlerController::class, 'upsert', [AuthMiddleware::class]);
$router->put("$common/wrestlers/status/change", WrestlerController::class, 'statusChange', [AuthMiddleware::class]);
$router->delete("$common/wrestlers/delete/{id}", WrestlerController::class, 'delete', [AuthMiddleware::class]);
