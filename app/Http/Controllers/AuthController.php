<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "error_code" => "invalid_credentials",
                "error_message" => "Username or password are invalid."
            ]);
        }

        $loginUserData = $validator->validated();

        $user = User::where(function ($query) use ($loginUserData) {
            $query->where('email', $loginUserData['username'])
                ->orWhere('username', $loginUserData['username']);
        })->first();

        if (!$user || !Hash::check($loginUserData['password'], $user->password)) {
            return response()->json([
                "error_code" => "invalid_credentials",
                "error_message" => "Username or password are invalid."
            ]);
        }
        $token = $user->createToken($user->name . '-AuthToken')->plainTextToken;
        return response()->json([
            "success" => true,
            "access_token" => $token,
        ]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'display_name' => 'required|string',
            'about_me' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ], 401);
        }

        $registerUserData = $validator->validated();
        $user = User::create([
            'username' => $registerUserData['username'],
            'email' => $registerUserData['email'],
            'password' => Hash::make($registerUserData['password']),
            'display_name' => $registerUserData['display_name'],
            'about_me' => $registerUserData['about_me']
        ]);
        return response()->json([
            "success" => true,
            "user" => $user
        ]);
    }
}
