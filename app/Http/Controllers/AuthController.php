<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepositories;
use App\Services\AuthServices\JwtAuthService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $jwtAuthService;

    public function __construct(JwtAuthService $jwtAuthService)
    {
        $this->jwtAuthService = $jwtAuthService;
    }

    public function login(Request $request)
    {
        $repo = new AuthRepositories($this->jwtAuthService);
        return $repo->login($request);
    }

    public function logout()
    {
        $repo = new AuthRepositories($this->jwtAuthService);
        return $repo->logout();
    }

}
