<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $posts = $user->posts()->with('author')->paginate();
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $data['author_id'] = $request->user()->id;
        $post = Post::create($data);
        return response()->json(new PostResource($post), 201);
    }

    public function show(Post $post)
    {
        abort_if(Auth::id() != $post->author_id, 403, 'Access Forbidden');

        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {

        abort_if(Auth::id() != $post->author_id, 403, 'Access Forbidden');

        $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => ['required', 'string', 'min:2']
        ]);

        $post->update($data);
        return new PostResource($post); 
    }

    public function destroy(Post $post)
    {
        abort_if(Auth::id() != $post->author_id, 403, 'Access Forbidden');

        $post->delete();
        return response()->noContent();
    }
}






