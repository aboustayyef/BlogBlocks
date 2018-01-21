<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
    
    public static function updateTopPost()
    {
        // Find the item with the highest score;
        $top_post = Static::orderBy('score','desc')->first();

        // If this post wasn't top post before, mark it as such and share on twitter
        if ($top_post->achieved_top_status == 0) {
            $top_post->achieved_top_status = 1;
            // Tweet new top post
        }
    }
}
