<?php

namespace App\Http\Controllers;

use App\Score;
use Illuminate\Http\Request;

class HotPostsApiController extends Controller
{
    public function index($count = 4, $tag = null)
    {
        if (!$tag) {
            return \App\Post::with(['media','source','score'])->orderBy('latest_score','desc')->take($count)->get();
        }
    }
}
