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
    public function register(Request $request): UserDetailResource{
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|email',
            'contact' => 'required|max:20|unique:users',
            'password' => 'required',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $newUser = User::create($validated);
        return new UserDetailResource($newUser);

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

       return $user->createToken('user login')->plainTextToken;
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
