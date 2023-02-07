<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/post')->group(function () {
    Route::get('/', [App\Http\Controllers\Post::class, 'index'])->name('post');
    Route::get('/{post_id}/delete', [App\Http\Controllers\Post::class, 'delete'])->name('post.delete');
    Route::get('/{post_id}/active', [App\Http\Controllers\Post::class, 'active'])->name('post.active');
    Route::get('/{post_id}/edit', [App\Http\Controllers\Post::class, 'edit'])->name('post.edit');
    Route::post('/store', [App\Http\Controllers\Post::class, 'store'])->name('post.store');
});
