<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); // Ambil semua postingan terbaru
        return view('feed', compact('posts'));
    }
}