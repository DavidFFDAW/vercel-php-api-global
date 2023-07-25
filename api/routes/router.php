<?php

Routes::get('/api/blog/all', BlogController::class, 'test', false);
Routes::get('/api/blog/single/post/:id', BlogController::class, 'test', false);
