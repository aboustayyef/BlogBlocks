<?php

Route::prefix('api')->group(function(){
    Route::get('posts/{count?}/{order?}', 'PostsApiController@index');
    Route::get('source', function(){
        return App\Source::all();
    })->middleware('auth');
});
