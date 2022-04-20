<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
// use App\Http\Controllers\Auth;

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
Route::get('/', [PostController::class, 'index'])->middleware('auth');
Route::get('/posts', [PostController::class, 'index'])->name('posts')->middleware('auth');
Route::get('/posts/create/', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('auth');
Route::post('/posts/update/{id}', [PostController::class, 'update'])->middleware('auth');
Route::post('/posts/destroy/{id}', [PostController::class, 'destroy'])->middleware('auth');
Route::get('/posts/show/{post}', [PostController::class, 'show'])->middleware('auth');
Route::get('/posts/edit/{toEdit}', [PostController::class, 'edit'])->middleware('auth');
Route::get('/posts/delete/{toDelete}', [PostController::class, 'delete'])->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/logout', [PostController::class, 'index'])->middleware('auth');

Route::post('test', [PostController::class, 'test']);



