<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePlantRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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

        $plants = Plant::where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        return response()->json($plants);
    }

    public function store(StorePlantRequest $request)
    {
        $plant = new Plant();
        $plant->fill($request->validated());
        $plant->owner()->associate(Auth::user());
        $plant->save();

        return response()->json(['message' => 'Plant created successfully', 'plant' => $plant]);
    }

    public function getPlantById(Plant $plant)
    {
        return response()->json(['plant' => $plant->load('owner', 'guardian', 'comments')]);
    }

    public function deletePlant(Plant $plant)
    {
        $plant->comments()->delete();
        $plant->delete();
        return response()->json(['message' => 'Plant deleted.']);
    }

    public function storeGuardian(Plant $plant) {
        $plant->guardian()->associate(Auth::user());
        $plant->save();

        return response()->json([
            'message' => 'A guardian has been assigned to the plant',
            'plant' => $plant->load('owner', 'guardian'),
        ]);
    }
}
