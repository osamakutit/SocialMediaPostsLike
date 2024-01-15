<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;


class AuthController extends Controller
{

    // Register Controller Auth
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 400);
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => "2" //for client user
        ]);

        return response()->json(['message' => 'Registered Successfully']);

    }
    
    // Login Controller Auth
    public function Login()
    {
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required|min:2',
    ]);

    if (! $token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Get the authenticated user
    $user = auth()->user();
    // save access token
    auth()->user()->update(['remember_token' => $token]);

    // Return the user model along with the token
    return response()->json([
        'user' => $user,
        'access_token' => $token,
    ]);
}
    

    public function Logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function RespondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}