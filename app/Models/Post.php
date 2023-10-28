<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];
    public function user() {
        return $this->belongsTo(User::class)->select(['id', 'name', 'username', 'email']);
    }
    public function comments() {
        return $this->hasMany(Comment::class)->select(['comment', 'user_id', 'created_at']);
    }
}
