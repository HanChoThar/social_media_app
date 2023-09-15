<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepositories;
use App\Services\AuthServices\JwtAuthService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $jwtAuthService;
    protected $authRepo;

    public function __construct(JwtAuthService $jwtAuthService)
    {
        $this->jwtAuthService = $jwtAuthService;
        $this->authRepo = new AuthRepositories();
    }

    public function login(Request $request)
    {
        return $this->authRepo->login($request, $this->jwtAuthService);
    }

    public function logout()
    {
        return $this->authRepo->logout($this->jwtAuthService);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }

        return $this->authRepo->resendPassword($request);
    }

}
