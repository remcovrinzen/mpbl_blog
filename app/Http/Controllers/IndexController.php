<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        $now = Carbon::now()->toDateTimeString();

        $posts = Post::where('published', '<=', $now)
            ->take(4)
            ->orderBy('published', 'desc')
            ->get();

        return view('index', ['posts' => $posts->toArray()]);
    }
}
