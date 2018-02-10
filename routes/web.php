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

$router->get('/v1', function () use ($router) {
    return response()->json(['status' => 'Api funcionando....'],200);;
});

$router->post('v1/login','AuthController@authenticate'); 
//combinar en un grupo prefijo y multiples middleware



$router->group(['prefix' => 'v1','middleware' => 'auth'], function () use ($router) {

    $router->get('dentro', ['as' => 'dentro', function () {
        return "hola, me deja entrar";
    }]);
   
   
   
});

