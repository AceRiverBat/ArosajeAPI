<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Plant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(StoreCommentRequest $request, Plant $plant): JsonResponse {
        $comment = new Comment();
        $comment->fill($request->validated());
        $comment->plant()->associate($plant);
        $comment->save();

        return response()->json([
           'message' => 'Comment created successfully'
        ]);
    }
}
