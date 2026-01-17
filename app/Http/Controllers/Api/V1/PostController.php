<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return 'index_v1';
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => ['required', 'string', 'min:2']
        ]);

        $data['author_id'] = 1;

        $post = Post::create($data);

        return response()->json($post, 201);
    }

    public function show(string $id)
    {
        return response()->json([
            [
                'message' => 'test',
                'data' => [
                    'id' => 1,
                    'title' => 'Test',
                    'body' => 'Post body',
                ]
            ]
        ])->header('Test', 'Zura');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}