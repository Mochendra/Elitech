<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
           'caption' => 'required|string|max:255',
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:153600', // 150 MB = 150 * 1024 KB
        ]);

        // Menyimpan file media
        $path = $request->file('media')->store('posts', 'public');

        // Membuat postingan baru
        $post = new Post();
        $post->user_id = Auth::id(); // Mengaitkan postingan dengan pengguna yang terautentikasi
        $post->caption = $request->input('caption');
        $post->media_path = $path;
        $post->media_type = $request->file('media')->getClientOriginalExtension() == 'mp4' ? 'video' : 'image';
        $post->content = $request->input('caption'); // Hapus jika tidak perlu

        $post->save();

        // Redirect atau berikan response yang sesuai
        return redirect()->route('feed.index')->with('success', 'Post berhasil diunggah!');
    }

    public function like(Post $post)
{
    \Log::info('Like method called for post: ' . $post->id);
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $like = $post->likes()->where('user_id', $user->id)->first();

    \DB::beginTransaction();
    try {
        if ($like) {
            $like->delete();
            $post->decrement('likes_count');
            $action = 'unliked';
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $post->increment('likes_count');
            $action = 'liked';
        }
        \DB::commit();

        return response()->json([
            'likes_count' => $post->fresh()->likes_count,
            'action' => $action
        ]);
    } catch (\Exception $e) {
        \DB::rollback();
        \Log::error('Like error: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred'], 500);
    }
}
}
