<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('imoveis/disponiveis', [\App\Http\Controllers\ImovelController::class, 'disponiveis']);
Route::apiResource('imoveis', \App\Http\Controllers\ImovelController::class);

Route::post('contratos', [\App\Http\Controllers\ContratoController::class, 'store']);
