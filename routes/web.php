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

Route::resource('/posts', PostsController::class)->except('create', 'edit');
Route::resource('/comments', CommentsController::class)->only(['store', 'destroy']);

Route::resource('/favourite-posts', FavouritePostsController::class)->only(['index', 'store']);
Route::get('/favourite-posts/get', [FavouritePostsController::class, 'getPosts'])->name('favourite-posts.get');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/favourite-posts', [FavouritePostsController::class, 'index'])->name('favourite-posts.index');
    Route::get('/my-answers', [PostsController::class, 'myAnswers'])->name('my-answers');
    Route::get('/my-topics', [PostsController::class, 'myTopics'])->name('my-topics');
});

Route::get('/posts-ajax', [PostsAjaxController::class, 'index'])->name('posts-ajax.index');
Route::delete('/posts-ajax', [PostsAjaxController::class, 'destroy'])->name('posts-ajax.destroy');

Route::get('/search', [PostsController::class, 'search']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/', function(){
    return redirect(route('posts.index'));
});
