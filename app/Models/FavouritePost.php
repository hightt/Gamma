<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Schema\Builder;

class FavouritePost extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'post_id'];

    public function checkIfExists($post_id)
    {
        return $this->where('user_id', Auth::user()->id)->where('post_id', $post_id)->exists();
    }
}
