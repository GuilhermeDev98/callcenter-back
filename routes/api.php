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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->role;
});

Route::prefix('auth')->group(function () {
    Route::post('/login', ['App\Http\Controllers\Api\Auth\LoginController', 'login']);
});

Route::prefix('users')->group(function () {
    Route::post('/', ['App\Http\Controllers\Api\UserController', 'store']);
});

Route::middleware(['auth:sanctum', 'CheckIfUserCanAccessAction'])->group(function () {
    Route::apiResource('roles', 'App\Http\Controllers\Api\RoleController');
    Route::patch('/roles/{role}/permission', ['App\Http\Controllers\Api\RoleController', 'associatePermission']);
    Route::patch('/users/{user}/role/{role}', ['App\Http\Controllers\Api\UserController', 'associateRole']);
    Route::apiResource('permissions', 'App\Http\Controllers\Api\PermissionController');
});
