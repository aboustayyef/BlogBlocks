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

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('test', function(){
	return view('vuetable');
});

Route::prefix('api')->middleware('auth')->group(function(){
	Route::get('blog', function(){
		return App\Blog::all();
	});
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::resource('blog', 'AdminBlogController')->except('show');
    Route::resource('tag', 'AdminTagController')->except('show');
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
