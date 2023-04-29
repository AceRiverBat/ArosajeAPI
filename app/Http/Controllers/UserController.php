<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    public function getUserPlants($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $plants = $user->plants;
        if (!$plants) {
            return response()->json(null);
        } else {
            $plantsArray = [];
            foreach ($plants as $plant) {
                $plantsArray[] = [
                    'id' => $plant->id,
                    'name' => $plant->name,
                    'description' => $plant->description,
                    'image' => $plant->image,
                ];
            }
            return response()->json(['plants' => $plantsArray]);
        }
    }

    public function getUserRole($Id)
    {
        $user = User::find($Id);
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
