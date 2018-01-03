<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group([
    'middleware'  => 'throttle',
    'namespace'   => 'Api\v1',
    'prefix'      => '/api/v1',
], function () use ($router) {
    $router->get('/user', 'UserController');

    $router->get('/posts', 'PostsController@index');
    $router->post('/posts', 'PostsController@store');
    $router->get('/posts/{id}', 'PostsController@show');
    $router->put('/posts/{id}', 'PostsController@update');
    $router->delete('/posts/{id}', 'PostsController@destroy');
});
