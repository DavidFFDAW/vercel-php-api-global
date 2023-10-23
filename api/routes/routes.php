<?php

$request = Request::getInstance();
$router = new Router($request);
$common = "/api/2k";

/* BLOG ROUTES */
$router->get("/api/", DocController::class, 'getDocs');
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

/** CHAMPIONSHIP AND REIGNS ROUTES */
$router->get("$common/championships/reigns/all", ChampionReignController::class, 'getAll');
$router->get("$common/championships/reign/single/{id}", ChampionReignController::class, 'getSingleReign');

/** TEAM ROUTES */
$router->get("$common/teams/", TeamController::class, 'getAll');
$router->get("$common/teams/members", TeamController::class, 'getAllTeamsWithMembers');
$router->get("$common/teams/team/{id}", TeamController::class, 'getSingleTeam');
$router->get("$common/teams/team/members/{id}", TeamController::class, 'getSingleTeamWithMembersById');
$router->post("$common/teams/create/team", TeamController::class, 'upsertTeam', [AuthMiddleware::class]);

/** TWITTER ROUTES */
$router->get("$common/twitter/", TwitterController::class, 'getAllTweetsWithReplies');
$router->get("$common/twitter/admin/tweets/list", TwitterController::class, 'getAdminAllTweets');
$router->get("$common/twitter/tweet/{id}", TwitterController::class, 'getSingleTweetWithReplies');
$router->post("$common/twitter/tweet/upsert", TwitterController::class, 'upsertTweet', [AuthMiddleware::class]);
$router->delete("$common/twitter/tweet/delete/{id}", TwitterController::class, 'deleteTweet', [AuthMiddleware::class]);
