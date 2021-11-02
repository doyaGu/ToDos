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

Route::get('/home', 'HomeController@index')->name('home');

// Friends
Route::post('/home/new-friend', 'UserController@newFriend')->name('user.new-friend');
Route::get('/user/{id}/confirm-friend', 'UserController@confirmFriend')->name('user.confirm-friend');
Route::get('/user/{id}/reject-friend', 'UserController@rejectFriend')->name('user.reject-friend');
Route::get('/user/{id}/delete-friend', 'UserController@deleteFriend')->name('user.delete-friend');
Route::post('/todolists/{id}/share', 'UserController@share')->name('user.share');


// Todolists
Route::get('/todolists/{id}/tasks', 'TaskController@index')->name('tasks.index');
Route::get('/todolists/create', 'TodolistController@showCreateForm')->name('todolists.create');
Route::post('/todolists/create', 'TodolistController@create');
Route::get('/todolists/{id}/delete', 'TodolistController@delete')->name('todolists.delete');

// Tasks
Route::get('/todolists/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
Route::post('/todolists/{id}/tasks/create', 'TaskController@create');
Route::get('/folders/{id}/tasks/{tid}/edit', 'TaskController@showEditForm')->name('tasks.edit');
Route::post('/folders/{id}/tasks/{tid}/edit', 'TaskController@edit');
Route::get('/todolists/{id}/tasks/{tid}/delete', 'TaskController@delete')->name('tasks.delete');
Route::get('/todolists/{id}/tasks/check-all', 'TaskController@checkAll')->name('tasks.check-all');
Route::get('/todolists/{id}/tasks/delete-completed', 'TaskController@deleteCompleted')->name('tasks.delete-completed');

Auth::routes();

