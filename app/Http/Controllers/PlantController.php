<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        return response()->json(Plant::all());
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $plants = Plant::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->get();

        return response()->json($plants);
    }

    public function create(Request $request, $userId)
    {
        $user = User::find($userId);

        $validatedData = $request->validate([
            'title' => 'required|string',
            'image' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
        ]);

        $plant = Plant::create([
            'title' => $validatedData['title'],
            'image' => $validatedData['image'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
        ]);

        $user->plants()->save($plant);

        return response()->json(['message' => 'Plant created successfully', 'plant' => $plant]);
    }
    public function getPlantById($id)
    {
        $plant = Plant::find($id);
        if (!$plant) {
            return response()->json(['message' => 'Plant not found.'], 404);
        } else {
            return response()->json(['plant' => $plant]);
        }
    }

    public function deletePlant($id)
    {
        $plant = Plant::find($id);
        if (!$plant) {
            return response()->json(['message' => 'Plant not found.'], 404);
        } else {
            $plant->delete();
            return response()->json(['message' => 'Plant deleted.']);
        }
    }
}
