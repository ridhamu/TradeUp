<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;





//users api
Route::post('/users', [AuthenticationController::class, 'register']);
Route::post('/users/login', [AuthenticationController::class, 'login']);
Route::delete('/users/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/users/current', [AuthenticationController::class, 'getCurrentUser'])->middleware(['auth:sanctum']);
Route::patch('/users/current', [AuthenticationController::class, 'updateCurrentUser'])->middleware(['auth:sanctum']);

//Bookmark api
Route::post('/products/{id}/bookmarks', [BookmarkController::class, 'createBookmark'])->middleware(['auth:sanctum']);
Route::get('/users/current/bookmarks', [BookmarkController::class, 'listBookmarks'])->middleware(['auth:sanctum']);
Route::delete('/users/current/bookmarks/{bookmarkID}', [BookmarkController::class, 'deleteBookmark'])->middleware(['auth:sanctum']);

//Comments api
Route::post('/products/{id}/comments', [CommentController::class, 'createComment'])->middleware(['auth:sanctum']);
Route::get('/products/{id}/comments', [CommentController::class, 'listComments'])->middleware(['auth:sanctum']);


//products api
Route::get('/products/search', [ProductController::class, 'searchProudct']);
Route::get('/products', [ProductController::class, 'listProducts']);
Route::get('/products/{id}', [ProductController::class, 'getProductById'])->middleware(['auth:sanctum']);
Route::post('/products', [ProductController::class, 'createProduct'])->middleware('auth:sanctum');
Route::put('/products/{id}', [ProductController::class, 'updateProduct'])->middleware('auth:sanctum');
Route::delete('/products/{id}', [ProductController::class, 'deleteProduct'])->middleware('auth:sanctum');


