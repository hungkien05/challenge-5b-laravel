<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadsController;
use App\Http\Controllers\ChallengesController;
use App\Http\Controllers\HomeworksController;
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

Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/services', [PagesController::class, 'services']);
Route::get('/edit-info', [PagesController::class, 'editInfo']);

Route::resource('posts', 'App\Http\Controllers\PostsController');
Route::resource('users', 'App\Http\Controllers\UsersController');
Route::resource('messages', 'App\Http\Controllers\MessagesController');
Route::resource('uploads', 'App\Http\Controllers\UploadsController');
Route::resource('homeworks', 'App\Http\Controllers\HomeworksController');
Route::resource('challenges', 'App\Http\Controllers\ChallengesController');

Auth::routes();
Route::get('/profile', [PagesController::class, 'profile']);
Route::post('/updateAuth', [ProfileController::class,'updateAuth'])->name('updateAuth');
Route::get('/uploads/{id}/getFile', [UploadsController::class, 'getFile']);
Route::get('/homeworks/{id}/getFile', [HomeworksController::class, 'getFile']);
Route::post('/challenges/check', [ChallengesController::class, 'check']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/root', function(){
	return $_SERVER['DOCUMENT_ROOT'];
});
