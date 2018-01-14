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

    public static function hot($count = 4)
    {
        $scores = Static::orderBy('score','desc')->take($count)->get();
        $results = collect([]);
        foreach ($scores as $score) {
            $post = $score->post;
            $media= $post->media;
            $source = $post->source;
            $sc = $post->score;
            $results->push(['post'=>$post]);
        }
        return $results;
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
