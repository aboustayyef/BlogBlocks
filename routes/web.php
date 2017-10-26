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

Route::get('/', function(){
    return view('home');
});

Route::get('/test', function(){

	/**
	 *
	 * This shows all the new posts added since seed
	 * 
	 */

	$nick = request()->get('nick'); // url has a ?nick= paramenter

	$source = App\Source::where('nickname', $nick)->first();

	$feed = $source->fetcher_source;	

	$f = Feeds::make($feed);
	
	$items = collect($f->get_items());

	$items = $items->filter(function($item){
		return ! App\Post::uidExists($item->get_id());
	})->map(function($item){
		return $item->get_title();
	});
	dd($items->toArray());
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('api')->middleware('auth')->group(function(){
	Route::get('source', function(){
		return App\Source::all();
	});
});

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::resource('source', 'AdminSourceController')->except('show');
    Route::resource('tag', 'AdminTagController')->except('show');
    Route::get('/', 'AdminController@index');
});
