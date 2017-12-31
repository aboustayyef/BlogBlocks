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
    Route::get('hot/{count?}/{tag?}', 'HotPostsApiController@index');
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
    $hot_posts = Score::with(['Post'])->orderBy('score','desc')->take(4)->get();
    $recent_posts = Post::orderBy('posted_at', 'desc')->take(10)->get();
    return view('home')->with(compact('hot_posts'))->with(compact('recent_posts'));
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

