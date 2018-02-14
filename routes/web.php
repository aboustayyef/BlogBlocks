<?php

use App\Analyzers\TwitterCounter;
use App\Post;
use App\Score;
use App\Source;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->group(function(){
    Route::get('posts/{count?}/{order?}', 'PostsApiController@index');
    Route::get('hot/{count?}/{tag?}', 'HotPostsApiController@index');
    Route::get('registerExit/{post}', 'ExitController@index');
    Route::get('source', function(){
        return App\Source::all();
    })->middleware('auth');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function(){
    return view('home');
});

Route::get('/test/{url}', function($url){
    return TwitterCounter::count($url, false);
});

/*
|--------------------------------------------------------------------------
| Auth and Admin Routes
|--------------------------------------------------------------------------
*/

$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::resource('source', 'AdminSourceController', ['as' => 'admin'])->except('show');
    Route::resource('tag', 'AdminTagController',['as' => 'admin'])->except('show');
    Route::get('/', 'AdminController@index');
});

