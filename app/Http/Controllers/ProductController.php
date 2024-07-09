<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function listProducts(){
        return ProductResource::collection(Product::all());
    }

    public function getProductById($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return new ProductDetailResource($product);
    }

    public function createProduct(Request $request,  CreateProductRequest $request2): ProductResource{
        $category = Category::where('name', $request->category)->first();
        $user = User::findOrFail($request->user()->id);

        if (!$category) {
            return response()->json(['error' => 'Category not found',
                '1' =>'clothing',
                '2' =>'electronics',
                '3' =>'books',
                '4' =>'sports',
                '5' =>'shoes'], 404);
        }


        $product = Product::create([
            'name' => $request2->name,
            'description' => $request2->description,
            'price' => $request2->price,
            'category_id' => $category->id,
            'image_url' => $request2->image_url,
            'user_id' => $user->id
        ]);

        return new ProductResource($product);
    }

    public function updateProduct(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'category' => 'nullable|string',
            'image_url' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $product = Product::find($id);


        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        if($product->user_id != $request->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($request->has('name')) {
            $product->name = $request->input('name');
        }

        if ($request->has('description')) {
            $product->description = $request->input('description');
        }

        if ($request->has('price')) {
            $product->price = $request->input('price');
        }

        if ($request->has('category')) {
            $category = Category::where('name', $request->input('category'))->first();

            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $product->category_id = $category->id;
        }

        if ($request->has('image_url')) {
            $product->image_url = $request->input('image_url');
        }

        $product->save();

        return response()->json([
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'category' => $category->name ?? $product->category->name,
                'image_url' => $product->image_url,
            ]
        ], 200);
    }

    public function deleteProduct($id, Request $request)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'data' => false,
                'errors' => ['message' => 'Product not found']
            ], 404);
        }

        if($product->user_id != $request->user()->id){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $product->delete();

        return response()->json([
            'data' => true,
            'errors' => []
        ], 200);
    }

    public function searchProudct(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'nullable|string',
            'category' => 'nullable|string'
        ]);

        $query = Product::query();

        if ($request->has('keyword') && $request->keyword) {
            $query->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%');
        }

        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $products = $query->get();

        return response()->json(['data' => $products]);
    }
}
