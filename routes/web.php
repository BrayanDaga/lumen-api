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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/api/login','UsersController@login');
$router->post('/api/users','UsersController@store');
/*
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('users','UsersController@index');
    $router->get('users/{id}','UsersController@show');
});
*/

$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
    $router->get('users','UsersController@index');
    $router->get('users/{id}','UsersController@show');
});
