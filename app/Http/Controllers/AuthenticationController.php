<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserDetailResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    //register user
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|email',
            'contact' => 'required|max:20|unique:users',
            'password' => 'required',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $newUser = User::create($validated);

        return response()->json(new UserDetailResource($newUser), 201);
    }
    // user login
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

       $user = User::where('email', $request->email)->first();

       if(!$user || ! Hash::check($request->password, $user->password)){
           throw ValidationException::withMessages([
               'errors' => ['email or password are incorrect.']
           ]);
       }

       $token = $user->createToken('user login')->plainTextToken;

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'contact' => $user->contact,
            'token' => $token,
        ], 200);
    }
    // user logout
    public function logout(Request $request): JsonResponse{
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successful.'], 200);
    }
    //get current user
    public function getCurrentUser(Request $request): UserDetailResource{
        return new UserDetailResource($request->user());
    }
    //update current user
    public function updateCurrentUser(Request $request): UserDetailResource{

        $user = User::findOrFail($request->user()->id);

        $validated = $request->validate([
            'name' => 'nullable|max:100',
            'email' => 'nullable|max:100|email' . $user->id,
            'contact' => 'nullable|max:20|unique:users,contact,' . $user->id,
            'password' => 'nullable',
        ]);

        if ($request->has('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update(array_filter($validated));

        return new UserDetailResource($user);
    }
}
