<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ['id', 'user_id', 'title', 'content', 'created_at', 'updated_at'];
    protected $appends = ['user', 'comment_num', 'formatted_created_at'];

    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->first();
    }

    public function getUserAttribute()
    {
        return $this->user();
    }

    public function getCommentNumAttribute()
    {
        return $this->comments()->count();
    }
    public function userCommentsBelongsToPost()
    {
        return $this->comments()->where('user_id', Auth::user()->id);
    }

    public function scopeMycomments($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }

}
