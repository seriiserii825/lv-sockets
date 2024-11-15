<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected $with = ['image', 'likedUsers', 'repostedPosts'];

    public function image(){
        return $this->hasOne(PostImage::class, 'post_id', 'id')->whereNotNull('post_id');
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'liked_posts', 'post_id', 'user_id');
    }

    public function repostedPosts(){
        return $this->belongsTo(Post::class, 'reposted_id', 'id');
    }

}
