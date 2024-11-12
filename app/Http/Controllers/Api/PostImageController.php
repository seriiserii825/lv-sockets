<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostImageController extends Controller
{
    public function store(Request $request)
    {
        return '111';
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        //
        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);
        //
        // return response()->json(['success'=>'You have successfully uploaded an image.']);
    }
}
