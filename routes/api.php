<?php

use App\Http\Controllers\Api\ArticleController;
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
    'prefix' => '/auth',
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
    'prefix' => '/projects',
    'as' => 'projects.',
    'controller' => ProjectController::class
], function () {
    Route::get('/get', 'getFilteredProjects')
        ->name('get');

    Route::get('/get/{project:id}', 'getProjectById')
        ->name('get.id');
});

Route::group([
    'prefix' => '/articles',
    'as' => 'articles.',
    'controller' => ArticleController::class
], function () {
    Route::get('/get', 'getFilteredArticles')->name('get');

    Route::get('/get/{article:id}', 'getArticleById')->name('get.id');

    Route::middleware('auth:sanctum')->group(function (){
        Route::post('/create', 'create')->name('create');

        Route::put('/{article}/update', 'update')->name('update');

        Route::delete('/{article:id}/delete', 'delete')->name('delete');
    });
});
