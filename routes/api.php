<?php

$app->get('/', function() use ($app) {
return view('index');
});

$app->get('api/comment', 'CommentController@getAll');
$app->post('api/comment', 'CommentController@post');
