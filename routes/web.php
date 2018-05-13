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

Route::get('/','TasksController@main');

//Create
Route::post('/api/tasks/','TasksController@store');
//Read
Route::get('/api/tasks/','TasksController@index');
Route::get('/api/tasks/{task}','TasksController@show');
//Update
Route::put('/api/tasks/{task}','TasksController@update');
Route::patch('/api/tasks/{task}/done','TasksController@done');
Route::patch('/api/tasks/{task}/undone','TasksController@undone');

//Delete
Route::delete('/api/tasks/{task}','TasksController@destroy');

