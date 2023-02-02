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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function() use ($router) {
    $router->group(['prefix' => 'materias'], function() use ($router) {

        $router->post('/create', 'MateriaController@store');
        $router->get('/{id}', 'MateriaController@show');
        $router->put('/{id}', 'MateriaController@update');
        $router->post('/create', 'MateriaController@store');

        // administrar los estudiantes por las materias
        $router->get('/search', 'MateriaController@buscarEstudiante');
        $router->post('/{id}/estudiante/{estudianteId}', 'MateriaController@agregarEstudiante');
    });
});

$router->post('login', 'AuthController@login');
$router->post('register', 'AuthController@register');
$router->get('logout', 'AuthController@logout');
