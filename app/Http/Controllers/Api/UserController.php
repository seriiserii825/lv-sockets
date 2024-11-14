<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::whereNot('id', auth()->id())->get();
        return UserResource::collection($users);
    }

    public function posts($id){
        $user = User::find($id);
        $posts = $user->posts;
        return PostResource::collection($posts);
    }
    public function show($id){
        $user = User::find($id);
        return new UserResource($user);
    }
}
