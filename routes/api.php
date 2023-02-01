<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoLlamadaController;
use App\Http\Controllers\OrigenLlamadaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'callType'
], function () {
    Route::get('all', [TipoLlamadaController::class, 'index']);
    Route::post('add', [TipoLlamadaController::class, 'store']);
    Route::get('show/{id}', [TipoLlamadaController::class, 'show']);
    Route::put('update/{id}', [TipoLlamadaController::class, 'update']);
    Route::delete('delete/{id}', [TipoLlamadaController::class, 'destroy']);
});

Route::group([
    'prefix' => 'originCall'
], function () {
    Route::get('all', [origenLlamadaController::class, 'index']);
    Route::post('add', [origenLlamadaController::class, 'store']);
    Route::get('show/{id}', [origenLlamadaController::class, 'show']);
    Route::put('update/{id}', [origenLlamadaController::class, 'update']);
    Route::delete('delete/{id}', [origenLlamadaController::class, 'destroy']);
});
