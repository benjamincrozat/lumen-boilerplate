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

/** @var $router Laravel\Lumen\Routing\Router */
$router->group(['prefix' => '/api/v1'], function () use ($router) {
    $router->group(['middleware' => 'throttle:60,1'], function () use ($router) {
        //
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->group([
            // Per user rate limit.
            'middleware' => 'throttle:rate_limit,1'
        ], function () use ($router) {
            $router->get('/user', 'UserController');

            $router->get('/posts', 'PostsController@index')
                ->post('/posts', 'PostsController@store')
                ->get('/posts/{id}', 'PostsController@show')
                ->put('/posts/{id}', 'PostsController@update')
                ->delete('/posts/{id}', 'PostsController@destroy');
        })
    });
});
