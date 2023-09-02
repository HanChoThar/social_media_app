<?php

namespace App\Services\AuthServices;

use Illuminate\Support\Facades\Validator;

class JwtAuthService implements AuthServiceInterface
{
    public function login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if($validator->fails()) return response()->json(['errors' => $validator->errors()], 422);

        $credential = $request->only('email', 'password');
        $token = auth()->attempt($credential);
        if(!$token) return response()->json(['errors' => 'Invalid email or password'], 401);

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

}