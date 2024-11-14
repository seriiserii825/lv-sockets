<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
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
    $posts = $user->posts;
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
}
