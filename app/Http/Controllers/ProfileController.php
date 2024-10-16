<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Settings; // Pastikan model settings sudah ada

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        if ($user) {
            $posts = $user->posts;
            return view('profile.profile', compact('user', 'posts'));
        }

        return redirect()->route('login')->with('error', 'Please login to view your profile.');
    }

    public function showProfile($id)
    {
        $user = User::find($id);
        $posts = Post::where('user_id', $id)->get();
        $settings = Setting::where('user_id', $id)->first(); // Pastikan ini menggunakan Setting

        return view('profile', [
            'user' => $user,
            'posts' => $posts,
            'feeds_per_row' => $settings->feeds_per_row ?? 3,
        ]);
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:1000',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $user->name = $request->name;
    $user->bio = $request->bio;

    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $path = public_path('images/profile/');
        $image->move($path, $filename);
        $user->profile_picture = 'images/profile/' . $filename;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui');
}
}
