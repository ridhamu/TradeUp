<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function createComment(Request $request, $productID){
        $currentUser = User::findOrFail($request->user()->id);

        if(!$currentUser){
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        $product = Product::findOrFail($productID);
        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }


        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'text' => request('text'),
            'product_id' => $product->id,
            'user_id' => $currentUser->id,
        ]);

        return response()->json(['comment' => $comment], 201);
    }


    public function listComments($productID): array{
        // Check if the productID is valid/check product exists
        $product = Product::findOrFail($productID);
        if(!$product){
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Get all comments that match the product_id
        $comments = Comment::where('product_id', $productID)->get();

        if ($comments->isEmpty()) {
            return response()->json(['message' => 'No comments yet'], 404);
        }

        return CommentResource::collection($comments);
    }

}
