<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CodeController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Roles\RoleUserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([

    'prefix' => 'auth'
], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});
Route::group([
    'middleware' => ['auth:sanctum', 'chekUser:admin'],
  
    'prefix' => 'admin'
], function () {
Route::post('/code',[CodeController::class,'store']);

Route::resource('/roles', RoleController::class);
Route::resource('/rolesUser', RoleUserController::class);

});