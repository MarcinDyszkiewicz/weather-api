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

use App\Services\WeatherService;
use Illuminate\Support\Facades\Route;

/** @var Route $router */

$router->get('/', function () use ($router) {

    return response()->json('Hello');
});

$router->get('city', 'CityController@show');
$router->get('city/{cityId}/weather', 'CityController@listWeathers');
$router->get('city/{cityId}/forecast', 'CityController@listForecasts');
