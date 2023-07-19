<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
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