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

Route::middleware('auth')->group(function (){
    Route::get('/tweets', 'TweetController@index')->name('home');
    Route::post('/tweets', 'TweetController@store');

    Route::get('/profile/{user}', ['as'=>'profile.show','uses'=>'ProfileController@show']);
    Route::get('/profile/{user}/edit', ['as'=>'profile.edit','uses'=>'ProfileController@edit'])->middleware('can:edit,user');
    Route::patch('/profile', ['as'=>'profile.update','uses'=>'ProfileController@update'])/*->middleware('can:edit,auth')*/;
    Route::post('/profile/{user}/follow', ['as'=>'followMe','uses'=>'FollowsController@store']);
    Route::get('/explore', ['as'=>'explore.index','uses'=>'ExploreController@index']);

    Route::post('/profile/{id}/like', ['as'=>'like','uses'=>'LikeController@like']);
    Route::post('/profile/{id}/dislike', ['as'=>'dislike','uses'=>'LikeController@dislike']);


});

