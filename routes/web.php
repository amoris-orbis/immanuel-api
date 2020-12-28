<?php

use App\Http\Controllers\ChartController;

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

// Lumen's router is more limited than Laravel's when it comes to optional params
$router->group(['middleware' => ['auth', 'access', 'validation', 'throttle', 'quota'], 'prefix' => 'chart'], function () use ($router) {
    $router->post('/{primaryChart:natal|solar|progressed}', 'ChartController@buildChart');
    $router->post('/{primaryChart:natal|solar|progressed}/{secondaryChart:natal|solar|progressed|synastry|transits}', 'ChartController@buildChart');
    $router->post('/{primaryChart:natal|solar|progressed}/{secondaryChart:natal|solar|progressed|synastry}/{transits:transits}', 'ChartController@buildChart');
});