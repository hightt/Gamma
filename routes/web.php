<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\App\Auth;
// use Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::resource('/posts', PostsController::class);
Route::resource('/comments', CommentsController::class);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/search', [PostsController::class, 'search']);
Route::get('/my-topics', [PostsController::class, 'myTopics']);
Route::get('/my-answers', [PostsController::class, 'myAnswers']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

