<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GlobalController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function () {
    return Auth::user();
});

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [AuthController::class, 'getUsers']);
    /* Route::resource('/do', GlobalController::class , [
        'names' => [
            'get' => 'get',
            'put' => 'put',
            'delete' => 'delete',
    ]]); */
    Route::post('/do/post', [GlobalController::class, 'post']);
    Route::put('/do/put/{id}', [GlobalController::class, 'put']);
    Route::delete('/do/delete/{id}', [GlobalController::class, 'delete']);
    Route::get('/do/get', [GlobalController::class, 'get']);
});
