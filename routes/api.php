<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user', [AuthController::class, 'getUser']);




Route::middleware('jwt.verify')->group(function() {
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', [TasksController::class, 'index']);
        Route::get('/create', [TasksController::class, 'create']);
        Route::post('/', [TasksController::class, 'store']);
        Route::get('/edit/{id}', [TasksController::class, 'edit']);
        Route::get('/{id}/total-time', [TasksController::class, 'getTotalTaskTime']);
        Route::get('/{id}', [TasksController::class, 'view']);
        Route::put('/{id}', [TasksController::class, 'update']);
        Route::delete('/{id}', [TasksController::class, 'delete']);
        Route::post('/{id}/log-time', [TasksController::class, 'createLogTime']);
    });
});
