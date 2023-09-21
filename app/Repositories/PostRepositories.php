<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepositories
{

    public function createPost($request)
    {
        $imageId = $request->has('image_id') ? $request->input('image_id') : null;
        $userId = auth()->id();

        $post = Post::create([
            'author_id' => $userId,
            'image_id' => $imageId,
            'title' => $request->title,
            'content' => $request->content
        ]);

        return response()->json([
            'post_id' => $post->id
        ], 201);
    }

    public function getAllPosts($request)
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate($request->limit, ['*'], 'page', $request->page);

        return response()->json($posts, 201);
    }

    public function getPostById($request)
    {
        $post = Post::find($request->id);

        return response()->json($post, 201);
    }
}
