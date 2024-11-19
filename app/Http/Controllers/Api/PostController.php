<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\Comment\StoreRequest as CommentStoreRequest;
use App\Http\Requests\Post\RepostRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Comment;
use App\Models\LikedPost;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())->latest()->get();
        $liked_posts = LikedPost::where('user_id', auth()->id())->get('post_id')->pluck('post_id')->toArray();
        $posts->map(function ($post) use ($liked_posts) {
            $post->is_liked = in_array($post->id, $liked_posts);
            return $post;
        });
        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $image_id = $data['image_id'];
            unset($data['image_id']);
            $data['user_id'] = auth()->id();
            $post = Post::create($data);
            $this->processImage($post, $image_id);

            if ($request['clear_storage']) {
                PostImage::clearStorage();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Failed to create post'
            ], 500);
        }
        return new PostResource($post);
    }

    public function repost(RepostRequest $repost, Post $post)
    {
        $data = $repost->validated();
        $data['user_id'] = auth()->id();
        $data['reposted_id'] = $post->id;
        Post::create($data);
    }

    protected function processImage($post, $image_id)
    {
        if (isset($image_id)) {
            $image = PostImage::find($image_id);
            $image->update(['post_id' => $post->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function toggleLiked(Post $post)
    {
        $res = auth()->user()->likedPosts()->toggle($post->id);
        $data['is_liked'] = count($res['attached']) > 0;
        $data['likes_count'] = $post->likedUsers()->count();
        return $data;
    }

    public function comment(Post $post, CommentStoreRequest $request)
    {
        $data['user_id'] = auth()->id();
        $data['post_id'] = $post->id;
        $comment = Comment::create(array_merge($data, $request->validated()));
        return new CommentResource($comment);
    }
}
