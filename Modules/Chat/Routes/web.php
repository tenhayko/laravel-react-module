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

Route::prefix('chat')->group(function() {
    Route::get('/', 'ChatController@index');
    Route::get('/chat', 'ChatController@chat');
    Route::get('messages', 'ChatController@fetchMessages');
    Route::post('messages', 'ChatController@sendMessage');
    Route::post('conversation', 'ChatController@getConversation');
});
Route::prefix('admin')->group(function() {
    Route::get('/chat', 'MessageController@index')->name('chat');
    Route::get('user/list', 'UserController@getList');
});
Route::post('/pusher/auth', 'ChatController@authenticate');
Route::get('/text', function(){
    echo '<textarea rows="4" cols="50" value="&#13;abc"></textarea>';
});