<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function createUser(Request $request) {

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        
    }

    public function login(Request $request)
    {
        $credential = $request->only('email', 'password');
        $token = auth()->attempt($credential);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'message' => 'successfully logged In',
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'message' => 'successfully logged out'
        ]);
    }

    public function getMe() 
    {
        return auth()->user();
    }


}
