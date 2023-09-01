<?php

namespace App\Repositories;

use App\Services\AuthServices\AuthServiceInterface;

class AuthRepositories
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login($request)
    {
        return $this->authService->login($request);
    }

    public function logout()
    {
        return $this->authService->logout();
    }
}