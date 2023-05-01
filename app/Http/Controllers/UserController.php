<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->firstName = $request->input('firstName');
        $user->lastName = $request->input('lastName');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->postCode = $request->input('postCode');

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    public function getUserRole($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $role = $user->role;
        if (!$role) {
            return response()->json(null);
        } else {
            return response()->json(['role' => $role]);
        }
    }
}
