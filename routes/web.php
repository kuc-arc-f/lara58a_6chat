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
//
//Route::get('/tasks/data1', 'TasksController@data1');
Route::resource('tasks', 'TasksController');
//
Route::get('/books/test3', 'BooksController@test3')->name('books.test3');
Route::post('/books/test2', 'BooksController@test2')->name('books.test2');;
Route::get('/books/test1', 'BooksController@test1')->name('books.test1');;
Route::resource('books', 'BooksController');
//
Route::resource('members', 'MembersController');
Route::resource('depts', 'DeptsController');
Route::resource('todos', 'TodosController');
//
Route::resource('plans', 'PlansController');
//
Route::post('/mdats/csv_import', 'MdatsController@csv_import')->name('mdats.csv_import');
Route::get('/mdats/csv_get', 'MdatsController@csv_get')->name('mdats.csv_get');
Route::get('/mdats/chart', 'MdatsController@chart')->name('mdats.chart');
Route::resource('mdats', 'MdatsController');
// chat
Route::get('/chats/add_member', 'ChatsController@add_member')->name('chats.add_member');
//Route::get('/chats/home', 'ChatsController@home')->name('chats.home');
Route::resource('chats', 'ChatsController');
//
Auth::routes();
//
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function () {
    return view('about');
});

/**************************************
 * API
 **************************************/
Route::prefix('api')->group(function(){
    //chats
    Route::get('/apichats/get_post', 'ApiChatsController@get_post');
    Route::post('/apichats/get_send_members', 'ApiChatsController@get_send_members');
    Route::post('/apichats/update_post_client', 'ApiChatsController@update_post_client');
    Route::post('/apichats/update_token', 'ApiChatsController@update_token');
    Route::post('/apichats/update_post', 'ApiChatsController@update_post');
    //sys
    Route::post('/apisystem/delete_db_day', 'ApiSystemController@delete_db_day');
    Route::post('/apisystem/get_fcm_init', 'ApiSystemController@get_fcm_init');
});
