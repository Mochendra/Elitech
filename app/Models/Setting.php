<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'feeds_per_row'];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
