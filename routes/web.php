<?php

use App\Analyzers\TwitterCounter;
use App\Post;
use App\Score;
use App\Source;
use App\Tag;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api')->group(function(){
    Route::get('posts/{count?}/{order?}', 'PostsApiController@index');
    Route::get('hot/{count?}/{tag?}', 'HotPostsApiController@index');

    // To Do -> remove from API and make special exit router
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

Route::get('/tag/{tag}', function($tag){
    if (! Tag::exists($tag)) {
        abort(404);
    };
    return view('home')->with('tag', $tag);
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

