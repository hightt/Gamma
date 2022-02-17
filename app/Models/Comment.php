<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['id', 'user_id', 'post_id', 'content', 'created_at', 'updated_at'];
    protected $appends = ['author_name'];
    use HasFactory;

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function getAuthorNameAttribute()
    {
        return User::find($this->user_id)->name;
    }
}
