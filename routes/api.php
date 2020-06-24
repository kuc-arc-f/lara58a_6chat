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
    //chats
    Route::options('cross_chats/get_chats', function () {
        return response()->json();
    });
    Route::post('cross_chats/get_chats', 'ApiCrosChatsController@get_chats');
    Route::options('cross_chats/get_member_info', function () {
        return response()->json();
    });
    Route::post('cross_chats/get_member_info', 'ApiCrosChatsController@get_member_info');
    Route::options('cross_chats/add_member', function () {
        return response()->json();
    });
    Route::post('cross_chats/add_member', 'ApiCrosChatsController@add_member');
    Route::options('cross_chats/delete_member', function () {
        return response()->json();
    });
    Route::post('cross_chats/delete_member', 'ApiCrosChatsController@delete_member');
    Route::options('cross_chats/get_join_chats', function () {
        return response()->json();
    });
    Route::post('cross_chats/get_join_chats', 'ApiCrosChatsController@get_join_chats');
    Route::options('cross_chats/create_chat', function () {
        return response()->json();
    });
    Route::post('cross_chats/create_chat', 'ApiCrosChatsController@create_chat');
    Route::options('cross_chats/update_chat', function () {
        return response()->json();
    });
    Route::post('cross_chats/update_chat', 'ApiCrosChatsController@update_chat');
    Route::options('cross_chats/delete_chat', function () {
        return response()->json();
    });
    Route::post('cross_chats/delete_chat', 'ApiCrosChatsController@delete_chat');
    Route::options('cross_chats/delete_post', function () {
        return response()->json();
    });
    Route::post('cross_chats/delete_post', 'ApiCrosChatsController@delete_post');
    Route::options('cross_chats/info_chat', function () {
        return response()->json();
    });
    Route::post('cross_chats/info_chat', 'ApiCrosChatsController@info_chat');
    Route::options('cross_chats/search_chat', function () {
        return response()->json();
    });
    Route::post('cross_chats/search_chat', 'ApiCrosChatsController@search_chat');    

    Route::get('cross_chats/csv_get', 'ApiCrosChatsController@csv_get');

    Route::get('cross_chats/get_post', 'ApiChatsController@get_post');
    Route::options('cross_chats/update_post', function () {
        return response()->json();
    });
    Route::post('cross_chats/update_post', 'ApiChatsController@update_post');
    Route::options('cross_chats/update_token', function () {
        return response()->json();
    });
    Route::post('cross_chats/update_token', 'ApiChatsController@update_token');

});