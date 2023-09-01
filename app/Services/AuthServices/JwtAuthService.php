<?php

namespace App\Services\AuthServices;

class JwtAuthService implements AuthServiceInterface
{
    public function login($request)
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

}