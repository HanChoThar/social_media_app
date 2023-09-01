<?php

namespace App\Services\AuthServices;

interface AuthServiceInterface
{
    public function login($request);
    public function logout();
}