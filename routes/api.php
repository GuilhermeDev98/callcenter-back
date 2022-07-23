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

Route::prefix('employees')->group(function () {
    Route::get('/', ['App\Http\Controllers\Api\EmployeeController', 'index']);
    Route::delete('/{user}', ['App\Http\Controllers\Api\EmployeeController', 'delete']);
});

Route::prefix('attendances')->group(function () {
    Route::get('/', ['App\Http\Controllers\Api\AttendanceController', 'index']);
    Route::post('/', ['App\Http\Controllers\Api\AttendanceController', 'store']);
    Route::get('/uuid', ['App\Http\Controllers\Api\AttendanceController', 'generateAttendanceUUID']);
    Route::put('/{Attendance}', ['App\Http\Controllers\Api\AttendanceController', 'update']);

});

Route::prefix('memos')->group(function () {
    Route::get('/{atenndance}', ['App\Http\Controllers\Api\MemoController', 'search']);
    Route::post('/', ['App\Http\Controllers\Api\MemoController', 'store']);
});

Route::prefix('clients')->group(function () {
    Route::get('/{registration}', ['App\Http\Controllers\Api\ClientController', 'index']);
    Route::get('/search/{search}', ['App\Http\Controllers\Api\ClientController', 'search']);
    Route::get('/{registration}/logs', ['App\Http\Controllers\Api\ClientController', 'showLogs']);
    Route::get('/{registration}/attendances', ['App\Http\Controllers\Api\ClientController', 'showAttendances']);
    Route::post('/', ['App\Http\Controllers\Api\ClientController', 'store']);
});

Route::apiResource('roles', 'App\Http\Controllers\Api\RoleController');
Route::apiResource('permissions', 'App\Http\Controllers\Api\PermissionController');
Route::patch('/roles/{role}/permission', ['App\Http\Controllers\Api\RoleController', 'associatePermission']);
Route::patch('/users/{user}/role/{role}', ['App\Http\Controllers\Api\UserController', 'associateRole']);


Route::middleware(['auth:sanctum', 'CheckIfUserCanAccessAction'])->group(function () {
    
});
