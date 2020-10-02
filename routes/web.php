<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
    return redirect(config('app.parent_site_url'));
});

$router->group(['middleware' => ['auth', 'throttle', 'access', 'quota', 'chart'], 'prefix' => 'chart'], function () use ($router) {
    $router->post('natal', 'ChartController@natalChart');
    $router->post('solar', 'ChartController@solarChart');
    $router->post('progressed', 'ChartController@progressedChart');
});
