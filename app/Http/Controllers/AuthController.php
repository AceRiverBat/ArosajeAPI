<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request): JsonResponse
    {
        $user = new User();
        $user->fill($request->validated());
        $user->id = Str::uuid();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return response()->json([
            'message' => 'Votre inscription est réussie'
        ]);
    }

    public function login(Request $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->get('email'))->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function currentUser(Request $request){
    return response()->json($request->user());
    }

}
