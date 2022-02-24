<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavouritePostsController;
use App\Http\Controllers\PostsAjaxController;
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
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/search', [PostsController::class, 'search']);
Route::get('/my-topics', [PostsController::class, 'myTopics'])->middleware('auth');
Route::get('/my-answers', [PostsController::class, 'myAnswers'])->middleware('auth');

Route::resource('/favourite-post', FavouritePostsController::class)->except([
    'create', 'update', 'show', 'edit', 'destroy'
]);

Route::delete('/delete-fav', [FavouritePostsController::class, 'delete'])->name('favourite-posts.delete');

Route::delete('/posts-ajax', [PostsAjaxController::class, 'destroy'])->name('posts-ajax.destroy');
Route::resource('/posts-ajax', PostsAjaxController::class)->except('create', 'update', 'edit', 'show', 'destroy');
