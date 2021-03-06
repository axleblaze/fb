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

$router->post('register', 'RegisterController@register');

$router->post('login', 'LoginController@login');

$router->get('user/{id}', 'LoginController@showUser');

$router->post('admin-login', 'AdminController@login');

$router->get('userlist', 'AdminController@index');

//$router->get('show' , 'LoginController@showUser')
