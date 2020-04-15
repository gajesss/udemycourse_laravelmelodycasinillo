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

Route::get('/home', 'HomeController@home' )->name('home');//->middleware('auth');
Route::get('/secret', 'HomeController@secret')
     ->name('secret')
     ->middleware('can:home.secret');
Route::get('/contact', 'HomeController@contact' )->name('contact');
Route::get('/', 'HomeController@welcome' )->name('welcome');
Route::resource ('/posts', 'PostController1');


Auth::routes();


