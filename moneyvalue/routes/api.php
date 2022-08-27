<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PairController;
use App\Http\Controllers\UserController;
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


//Route::apiResource('users', UserController::class);
Route::post("register", [UserController::class,"register"]);
Route::post("login", [UserController::class,"login"]);
//Route::post("logout", [UserController::class,"logout"]);
Route::get('test/{value}/{currency_from}/{currency_to}', [PairController::class,"convert"]);
Route::apiResource('currencies', CurrencyController::class);
Route::apiResource('pairs', PairController::class);
Route::get("logout", [UserController::class,"logout"])->middleware('auth:sanctum');





