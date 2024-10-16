<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment; // Tambahkan ini jika belum ada


class Post extends Model
{
    use HasFactory;

    // Define the fillable fields for mass assignment
    protected $fillable = ['user_id', 'caption', 'media_type', 'media_path','likes_count'];

    // A post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A post has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
