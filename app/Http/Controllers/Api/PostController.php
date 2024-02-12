<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Http\Services\PostService;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    )
    {}

    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection(Post::all());
    }

    public function store(PostRequest $request): PostResource
    {
        $post = $this->postService->createPost($request);

        return new PostResource($post);
    }

    public function show(Post $post): PostResource
    {
        return new PostResource($post);
    }

    public function update(PostRequest $request, Post $post): PostResource
    {
        $post->update($request->validated());

        return new PostResource($post);
    }

    public function destroy(Post $post): Response
    {
        // $this->postService->deletePost($post);

        return response()->noContent();
    }
}
