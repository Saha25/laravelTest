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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/new-task', 'TaskController@index')->name('new-task');

Route::post('/new-task', 'TaskController@save');

Route::get('/task-list', 'TaskController@getTaskList')->name('task-list');

Route::post('/task-list', 'TaskController@getTaskList')->name('task-list');

Route::post('/detete-task', 'TaskController@delete')->name('delete-task');

Route::post('/done-task', 'TaskController@markDone')->name('done-task');

Route::get('/edit-task', 'TaskController@getTask')->name('edit-task');

Route::post('/edit-task', 'TaskController@updateTask')->name('edit-task');

Route::get('/search', 'TaskController@search')->name('search');