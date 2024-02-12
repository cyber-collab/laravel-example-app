<?php

namespace App\Http\Services;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostService
{
    public function createPost(PostRequest $request): Post
    {
        $post = Post::create($request->validated());

        return $post;
    }
}
