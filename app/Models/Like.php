<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id', // Puedo eliminar el post_id porque ya detecta la relación desde Post::likes()
    ];
    // public function user() {
    //     return $this->belongsTo(User::class)->select(['id', 'name', 'username', 'email']);
    // }
    // public function post() {
    //     return $this->belongsTo(Post::class)->select(['title', 'description', 'image']);
    // }
}
