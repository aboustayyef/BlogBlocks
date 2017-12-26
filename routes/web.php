<?php

use App\Post;
use App\Score;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->group(function(){
    Route::get('posts/{count?}/{order?}', 'PostsApiController@index');
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
    $scores = Score::with(['Post'])->orderBy('score','desc')->take(5)->get();
    return view('home')->with(compact('scores'));
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

