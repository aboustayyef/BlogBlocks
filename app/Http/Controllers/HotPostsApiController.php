<?php

namespace App\Http\Controllers;

use App\Score;
use App\Tag;
use Illuminate\Http\Request;

class HotPostsApiController extends Controller
{
    public function index($count = 4, $tag = null)
    {
        if (!$tag) {
            return \App\Post::with(['media','source','score'])->orderBy('latest_score','desc')->take($count)->get();
        }
        return Tag::getByNickname($tag)->posts()->where('latest_score','>', 0.00)->orderBy('latest_score','desc')->take($count)->get()->map(function($post){
        	$post->media;$post->source;$post->score;
        	return $post;
        });
    }
}
