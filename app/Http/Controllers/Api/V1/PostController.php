<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return 'index_v1';
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return $data;
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