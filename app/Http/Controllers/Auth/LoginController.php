<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function store(LoginRequest $request): array
    {
        $request->authenticate();
        $user = $request->user();
        $token = $user->createToken('main')->plainTextToken;
        return [
            'user' => new UserResource($user),
            'token' => $token
        ];
    }

    public function destroy(Request $request): Response
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->noContent();
    }
}
