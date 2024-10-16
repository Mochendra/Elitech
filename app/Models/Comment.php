<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'comment'];

    // Sebuah komentar dimiliki oleh sebuah pos
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Sebuah komentar dimiliki oleh seorang pengguna
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
