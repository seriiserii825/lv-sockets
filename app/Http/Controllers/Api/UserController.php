<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\LikedPost;
use App\Models\Post;
use App\Models\SubscriberFollowing;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();
        $following_ids = SubscriberFollowing::where('subscriber_id', auth()->id())->get('following_id')->pluck('following_id')->toArray();
        $users->map(function ($user) use ($following_ids) {
            $user->is_followed = in_array($user->id, $following_ids);
            return $user;
        });
        return UserResource::collection($users);
    }

    public function posts(User $user)
    {
        $posts = $user->posts()->latest()->get();
        $posts = $this->prepareLikedPosts($posts);
        return PostResource::collection($posts);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function toggleFollowing(User $user)
    {
        $res = auth()->user()->followings()->toggle($user->id);
        return  count($res['attached']) > 0;
    }

    public function followingPosts()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        $following_ids = auth()->user()->followings->pluck('id')->toArray();
        $liked_posts = LikedPost::where('user_id', auth()->id())->get('post_id')->pluck('post_id')->toArray();
        $posts = Post::whereIn('user_id', $following_ids)->whereNotIn('id', $liked_posts)->get();

        return PostResource::collection($posts);
    }

    private function prepareLikedPosts($posts)
    {
        $liked_posts = LikedPost::where('user_id', auth()->id())->get('post_id')->pluck('post_id')->toArray();
        $posts->map(function ($post) use ($liked_posts) {
            $post->is_liked = in_array($post->id, $liked_posts);
            return $post;
        });
        return $posts;
    }

    public function authUser()
    {
        return new UserResource(auth()->user());
    }
}
