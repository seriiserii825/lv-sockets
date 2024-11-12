<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostImage\StoreRequest;
use App\Http\Resources\PostImageResource;
use App\Models\PostImage;
use Illuminate\Support\Facades\Storage;

class PostImageController extends Controller
{
    public function store(StoreRequest $request)
    {
        $path = Storage::disk('public')->put('/images', $request->file('image'));
        $image =       PostImage::create([
            'path' => $path,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
        ]);
        return new PostImageResource($image);
    }
}
