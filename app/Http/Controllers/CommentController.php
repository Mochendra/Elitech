<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|max:255',
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment; 
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->save();

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}