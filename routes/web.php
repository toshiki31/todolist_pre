<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\FavoriteController;

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

Route::group(['middleware' => 'auth'], function () {
  //いいね
  Route::post('todolist/{todolist}/favorites', [FavoriteController::class, 'store'])->name('favorites');
  Route::post('todolist/{todolist}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
  // マイページを表示
  Route::get('/todolist/mypage', [TodolistController::class, 'mydata'])->name('todolist.mypage');
  
  Route::resource('todolist', TodolistController::class);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
