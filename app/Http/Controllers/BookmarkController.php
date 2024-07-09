<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Product;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function createBookmark(Request $request, $productID){
        $product = Product::find($productID);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        // Check apakah item sudah pernah di bookmark
        $existingBookmark = Bookmark::where('user_id', $request->user()->id)
            ->where('product_id', $productID)
            ->first();

        if ($existingBookmark) {
            return response()->json(['message' => 'Product already bookmarked'], 400);
        }

        // Create new bookmark
        $bookmark = Bookmark::create([
            'user_id' => $request->user()->id,
            'product_id' => $product->id,
        ]);

        return response()->json(['data' => $bookmark], 201);
    }

    public function listBookmarks(Request $request)
    {
        // Mengambil semua bookmark milik pengguna yang sedang login
        $bookmarks = Bookmark::where('user_id', $request->user()->id)->get();

        if ($bookmarks->isEmpty()) {
            return response()->json(['message' => 'No bookmarks yet'], 404);
        }

        return response()->json(['data' => $bookmarks], 200);
    }

    public function deleteBookmark(Request $request, $bookmarkID)
    {
        // Cari bookmark berdasarkan ID dan pastikan milik user yang sedang login
        $bookmark = Bookmark::where('id', $bookmarkID)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$bookmark) {
            return response()->json(['message' => 'Bookmark not found or does not belong to the user'], 404);
        }

        // Hapus bookmark
        $bookmark->delete();

        return response()->json(['data' => true, 'message' => 'Bookmark deleted successfully'], 200);
    }
}
