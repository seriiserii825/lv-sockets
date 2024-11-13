<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PostImage extends Model
{
    use HasFactory;
    protected $guarded = false;

    public function getUrlAttirbute()
    {
        return asset('storage/' . $this->path);
    }

    public static function clearStorage()
    {
        $images = PostImage::where('user_id', auth()->id())->whereNull('post_id')->get();
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
    }
}
