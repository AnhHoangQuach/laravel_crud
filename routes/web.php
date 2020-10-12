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

Route::get('/task', 'TaskController@index')->name('tasks');

Route::post('/task/add', 'TaskController@addPost');

Route::get('/task/edit/{id}', 'TaskController@edit');

Route::get('/task/show/{id}', 'TaskController@showPost');

Route::post('/task/update/{task}', 'TaskController@updatePost');

Route::delete('/task/delete/{task}', 'TaskController@deletePost');
