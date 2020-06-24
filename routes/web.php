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
Route::resource('vue_tasks', 'VueTasksController');

//
Route::get('/books/test3', 'BooksController@test3')->name('books.test3');
Route::post('/books/test2', 'BooksController@test2')->name('books.test2');;
Route::get('/books/test1', 'BooksController@test1')->name('books.test1');;
Route::resource('books', 'BooksController');
Route::resource('vue_books', 'VueBooksController');

//
Route::resource('members', 'MembersController');
Route::resource('depts', 'DeptsController');
Route::post('/todos/search_index', 'TodosController@search_index')->name('todos.search_index');
Route::resource('todos', 'TodosController');
Route::resource('vue_todos', 'VueTodosController');
//
Route::post('/vue_sort_items/update_number', 'VueSortItemsController@update_number')->name('vue_sort_items.update_number');
Route::resource('vue_sort_items', 'VueSortItemsController');
//
Route::get('/plans/week', 'PlansController@week')->name('plans.week');
Route::resource('plans', 'PlansController');
//
Route::post('/mdats/csv_import', 'MdatsController@csv_import')->name('mdats.csv_import');
Route::get('/mdats/csv_get', 'MdatsController@csv_get')->name('mdats.csv_get');
Route::get('/mdats/chart', 'MdatsController@chart')->name('mdats.chart');
//
Route::get('/mdats/test1', 'MdatsController@test1')->name('mdats.test1');
Route::resource('mdats', 'MdatsController');
// chat
Route::get('/chats/csv_get', 'ChatsController@csv_get')->name('chats.csv_get');
Route::get('/chats/info_chat', 'ChatsController@info_chat')->name('chats.info_chat');
Route::get('/chats/add_member', 'ChatsController@add_member')->name('chats.add_member');
Route::get('/chats/delete_member', 'ChatsController@delete_member')->name('chats.delete_member');
Route::get('/chats/next_join', 'ChatsController@next_join')->name('chats.next_join');
Route::get('/chats/home', 'ChatsController@home')->name('chats.home');
Route::get('/chats/test', 'ChatsController@test')->name('chats.test');

Route::post('/chats/search_index', 'ChatsController@search_index')->name('chats.search_index');
Route::resource('chats', 'ChatsController');
//messages
//Route::post('/messages/search_index', 'MessagesController@search_index')->name('messages.search_index');
//Route::get('/messages/test', 'MessagesController@test')->name('messages.test');
Route::get('/messages/show_sent', 'MessagesController@show_sent')->name('messages.show_sent');
Route::get('/messages/reply', 'MessagesController@reply')->name('messages.reply');
Route::get('/messages/export', 'MessagesController@export')->name('messages.export');
Route::resource('messages', 'MessagesController');

//bbs
Route::post('/bbs/confirm', 'BbsPostsController@confirm')->name('bbs.confirm');
Route::post('/bbs/search_index', 'BbsPostsController@search_index')->name('bbs.search_index');
Route::resource('bbs', 'BbsPostsController');
Route::resource('bbs_answers', 'BbsAnswersController');
//
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function () {
    return view('about');
});
//
Route::get('/users/test', 'UsersController@test')->name('users.test');
Route::get('/users/valid_go', 'UsersController@valid_go')->name('users.valid_go');
Route::post('/users/get_user', 'UsersController@get_user');
Route::get('/users/next_auth', 'UsersController@next_auth')->name('users.next_auth');
Route::resource('users', 'UsersController');
Route::resource('mypage', 'MypageController');

/**************************************
 * API
 **************************************/
Route::prefix('api')->group(function(){
    // sort_items
    Route::get('/api_sort_items/get_items', 'ApiSortItemsController@get_items');    
    //book
    Route::post('/apibooks/delete_task', 'ApiBooksController@delete_task');
    Route::post('/apibooks/update_post', 'ApiBooksController@update_post');
    Route::post('/apibooks/get_item', 'ApiBooksController@get_item');
    Route::post('/apibooks/create_book', 'ApiBooksController@create_book');    
    Route::get('/apibooks/get_tasks', 'ApiBooksController@get_tasks');
    Route::resource('apibooks', 'ApiBooksController' );    
    //todo
    //    Route::get('/apitodos/test1', 'ApiTodosController@test1');
    Route::post('/apitodos/get_item', 'ApiTodosController@get_item');
    Route::post('/apitodos/search', 'ApiTodosController@search');
    Route::post('/apitodos/update_todo', 'ApiTodosController@update_todo');    
    Route::post('/apitodos/create_todo', 'ApiTodosController@create_todo');
    Route::post('/apitodos/delete_todo', 'ApiTodosController@delete_todo');    
    Route::resource('apitodos', 'ApiTodosController' );
    //tasks
    Route::post('/apitasks/create_task', 'ApiTasksController@create_task');
    Route::post('/apitasks/update_post', 'ApiTasksController@update_post')->name('apitasks.update_post');
    Route::post('/apitasks/delete_task', 'ApiTasksController@delete_task');
    Route::get('/apitasks/get_tasks', 'ApiTasksController@get_tasks');
    Route::post('/apitasks/get_item', 'ApiTasksController@get_item');
//    Route::resource('apitasks', 'ApiTasksController' );    
    //chats
    Route::get('/apichats/get_post', 'ApiChatsController@get_post');
    Route::get('/apichats/get_notify_menu', 'ApiChatsController@get_notify_menu');
//    Route::get('/apichats/get_notify_index', 'ApiChatsController@get_notify_index');
    Route::post('/apichats/get_send_members', 'ApiChatsController@get_send_members');
    Route::post('/apichats/update_post_client', 'ApiChatsController@update_post_client');
    Route::post('/apichats/update_token', 'ApiChatsController@update_token');
    Route::post('/apichats/update_post', 'ApiChatsController@update_post');
    Route::post('/apichats/delete_post', 'ApiChatsController@delete_post');
    // messages
    Route::post('/apimessages/get_last_item', 'ApiMessagesController@get_last_item');
    Route::post('/apimessages/get_item', 'ApiMessagesController@get_item');
    Route::post('/apimessages/get_sent_item', 'ApiMessagesController@get_sent_item');
    Route::post('/apimessages/get_user', 'ApiMessagesController@get_user');
    Route::post('/apimessages/search', 'ApiMessagesController@search');

    //sys
    Route::post('/apisystem/delete_db_day', 'ApiSystemController@delete_db_day');
    Route::post('/apisystem/get_fcm_init', 'ApiSystemController@get_fcm_init');
    Route::post('/apisystem/get_google_auth', 'ApiSystemController@get_google_auth');
});
