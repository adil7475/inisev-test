<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
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

Route::post('/websites/{website}/posts', [PostController::class, 'store'])->name('posts.store');
Route::post('/user/{user}/website/{website}', [UserController::class, 'subscribeToWebsite'])->name('user.website.subscription.store');
