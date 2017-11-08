<?php

use Illuminate\Http\Request;

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

$router->get('/', function () {
    return view('home');
});

$router->group([
    'middleware' => 'auth',
    'namespace' => 'Api\v1',
    'prefix' => 'api/v1',
], function () use ($router) {
    $router->get('user', 'UserController');
});
