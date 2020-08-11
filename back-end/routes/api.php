<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'API\AuthController@login')->name('login');

Route::get('arquivos/{arquivo}', 'ArquivoController@show');

Route::middleware(['auth:api'])->group(function () {
    Route::post('registro', 'API\AuthController@registro')->name('registro');
    Route::post('deleta', 'API\AuthController@destroy');
    Route::get('usuarios', 'API\AuthController@show');

    Route::apiResource('status', 'API\StatusController');
    Route::apiResource('equipamento', 'API\EquipamentosController');
    Route::apiResource('estoque', 'API\EstoqueController');

    Route::get('meu-perfil', 'AuthController@meuPerfil')->name('perfil');

    Route::apiResource('arquivos', 'ArquivoController')->except([
        'show'
    ]);

});

Route::get('teste', function(){
    return 'abc';
});

