<?php

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
Route::get('/','TodoController@showList' )->name('todos')->middleware('auth');
Route::get('/todo/create', 'TodoController@showCreate')->name('create');
Route::get('/todo/edit/{id}', 'TodoController@showEdit');

Route::get('/logout','TodoController@logout' )->name('logout');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
