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

Route::get('/', 'HomeController@home' )->name('home');//->middleware('auth');
Route::get('/home', 'HomeController@home' )->name('start');
Route::get('/welcome', 'HomeController@welcome' )->name('welcome');
Route::get('/secret', 'HomeController@secret')
     ->name('secret')
     ->middleware('can:home.secret');
Route::get('/contact', 'HomeController@contact' )->name('contact');


Route::resource ('/posts', 'PostController1');


Auth::routes();


