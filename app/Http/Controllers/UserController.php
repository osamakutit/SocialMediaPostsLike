<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;


class UserController extends Controller
{
    public function list()
    {
        if (Auth::user()->isAdmin()) {
            $users = User::all();
        }
        else{
            $users = [Auth::user()];
        }
            return UserResource::collection($users);
    }

    public function show($id = null)
    {
        if (Auth::user()->isAdmin()) {
            $user = User::find($id);
        }
        else{
            $user = [Auth::user()];
        }
    
        if ($user) {
            return new UserResource($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function showw()
{
    $user = Auth::user();

    if ($user) {
        return new UserResource($user);
    } else {
        return response()->json(['error' => 'User not found'], 404);
    }
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|integer|min:1|max:2',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);
        if (!$user){
            return "false";
        }

        return response()->json(['message' => 'User created successfully']);
    }

    public function update(Request $request, $id = null)
    {
        if (Auth::user()->isAdmin()) {
            $user = User::find($id);
        }
        else {
            $id = Auth::id();
            $user = User::find($id);
        }
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $rules = [
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:6',
        ];
        
        if (Auth::user()->isAdmin()) {
            $rules['role'] = 'integer';
        }
        
        $validatedData = $request->validate($rules);
    
        $user->update($validatedData);
    
        return response()->json(['message' => 'User updated successfully']);
    }

    public function delete($id = null)
    {
        if (Auth::user()->isAdmin()) {
            $user = User::find($id);
        }
        else {
            $id = Auth::id();
            $user = User::find($id);
        }
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        $user->delete();
    
        return response()->json(['message' => 'User deleted successfully']);
    }

    
}
