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

$router->get('storage/{name}', 'ProductController@image');

$router->group(['prefix' => 'api'], function($router) {

    $router->get('/products', 'ProductController@index');
    $router->get('/products/{id}', 'ProductController@show');
    $router->post('/products', 'ProductController@store');
    $router->put('/products/{id}', 'ProductController@update');
    $router->delete('/products/{id}', 'ProductController@destroy');

    $router->get('/dishes', 'DishController@index');
    $router->get('/dishes/{id}', 'DishController@show');
    $router->get('/dishes/{id}/products', 'DishController@showProducts');
    $router->post('/dishes', 'DishController@store');
    $router->put('/dishes/{id}', 'DishController@update');
    $router->delete('/dishes/{id}', 'DishController@destroy');

    $router->get('/orders', 'OrderController@index');
    $router->get('/orders/{id}', 'OrderController@show');
    $router->get('/orders/{id}/products', 'OrderController@showProducts');
    $router->get('/orders/{id}/dishes', 'OrderController@showDishes');
    $router->post('/orders', 'OrderController@store');
    $router->put('/orders/{id}', 'OrderController@update');

});
