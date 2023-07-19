<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => '/v1/auth',
    'as' => 'auth.',
    'controller' => AuthController::class
], function () {
    Route::post('/login', 'login')
        ->name('login');

    Route::post('/registration', 'registration')
        ->name('registration');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/logout', 'logout')
            ->name('logout');
    });
});

Route::group([
    'prefix' => '/v1/projects',
    'as' => 'projects.',
    'controller' => ProjectController::class
], function () {
    Route::get('/get', 'getFilteredProjects')
        ->name('get');

    Route::get('/get/{project:id}', 'getProjectById')
        ->name('get.id');
});

