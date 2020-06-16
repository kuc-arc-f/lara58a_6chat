<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//
Route::middleware(['cors'])->group(function () {
    //tasks
    Route::get('test_tasks', 'ApiTasksController@test_tasks');
    Route::get('cross_task/get_tasks', 'ApiCrosTasksController@get_tasks');
    Route::options('cross_task/create_task', function () {
        return response()->json();
    });
    Route::post('cross_task/create_task', 'ApiCrosTasksController@create_task');
    Route::options('cross_task/get_item', function () {
        return response()->json();
    });
    Route::post('cross_task/get_item', 'ApiCrosTasksController@get_item');
    Route::options('cross_task/update_post', function () {
        return response()->json();
    });
    Route::post('cross_task/update_post', 'ApiCrosTasksController@update_post');
    Route::options('cross_task/delete_task', function () {
        return response()->json();
    });
    Route::post('cross_task/delete_task', 'ApiCrosTasksController@delete_task');
    //user
    Route::options('cross_user/get_user', function () {
        return response()->json();
    });
    Route::post('cross_user/get_user', 'UsersController@get_user');
    //toto
    Route::options('cross_todos/get_items', function () {
        return response()->json();
    });    
    Route::post('cross_todos/get_items', 'ApiCrosTodosController@get_items');
    Route::options('cross_todos/create_todo', function () {
        return response()->json();
    });    
    Route::post('cross_todos/create_todo', 'ApiCrosTodosController@create_todo' );
    Route::options('cross_todos/get_item', function () {
        return response()->json();
    });    
    Route::post('cross_todos/get_item', 'ApiTodosController@get_item' );
    Route::options('cross_todos/update_todo', function () {
        return response()->json();
    });    
    Route::post('cross_todos/update_todo', 'ApiTodosController@update_todo' );
    Route::options('cross_todos/delete_todo', function () {
        return response()->json();
    });    
    Route::post('cross_todos/delete_todo', 'ApiTodosController@delete_todo' );
    Route::options('cross_messages/get_item', function () {
        return response()->json();
    });
    Route::post('cross_messages/get_item', 'ApiMessagesController@get_item' );
    Route::options('cross_messages/get_sent_item', function () {
        return response()->json();
    });
    Route::post('cross_messages/get_sent_item', 'ApiMessagesController@get_sent_item' );
    Route::options('cross_messages/create_message', function () {
        return response()->json();
    });
    Route::post('cross_messages/create_message', 'ApiCrosMessagesController@create_message' );
    Route::options('cross_messages/get_user', function () {
        return response()->json();
    });
    Route::post('cross_messages/get_user', 'ApiMessagesController@get_user');
    Route::options('cross_messages/get_message', function () {
        return response()->json();
    });
    Route::post('cross_messages/get_message', 'ApiCrosMessagesController@get_message' );
    Route::options('cross_messages/get_sent_message', function () {
        return response()->json();
    });
    Route::post('cross_messages/get_sent_message', 'ApiCrosMessagesController@get_sent_message' );
    Route::options('cross_messages/delete_message', function () {
        return response()->json();
    });
    Route::post('cross_messages/delete_message', 'ApiCrosMessagesController@delete_message' );
    Route::options('cross_messages/get_last_item', function () {
        return response()->json();
    });
    Route::post('cross_messages/get_last_item', 'ApiMessagesController@get_last_item' );
    Route::options('cross_messages/search', function () {
        return response()->json();
    });
    Route::post('cross_messages/search', 'ApiMessagesController@search' );

    Route::get('cross_messages/export', 'ApiCrosMessagesController@export');

});