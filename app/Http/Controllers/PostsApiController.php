<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsApiController extends Controller
{
    public function index($count = 10, $order='latest')
    {
        if ($order == 'latest') {
            return \App\Post::with(['media','source'])->orderBy('posted_at','desc')->take($count)->get();
        }
    }
}
