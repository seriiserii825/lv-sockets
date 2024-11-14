<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = false;

    // for one request for post, will get the image
    protected $with = ['image'];

    public function image(){
        return $this->hasOne(PostImage::class, 'post_id', 'id')->whereNotNull('post_id');
    }

}
