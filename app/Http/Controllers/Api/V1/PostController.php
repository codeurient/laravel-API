<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::with('author')->get());
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $data['author_id'] = 2;
        $post = Post::create($data);
        return response()->json(new PostResource($post), 201);
    }

    public function show(Post $post)
    {
        return response()->json(new PostResource($post));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => ['required', 'string', 'min:2']
        ]);

        $post->update($data);
        return new PostResource($post); 
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}