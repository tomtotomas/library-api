<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user', 
        ]);

        $exists = User::where('email', $validatedData['email'])->orWhere('username', $validatedData['username'])->exists();

        if ($exists) {
            return response()->json(['message' => 'User already exists'], 409);
        }

        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

}
