<?php

namespace App\Http\Controllers;

use App\Helpers\CustomValidation;
use App\Models\User;
use App\Repositories\UserRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use CustomValidation; 

    protected $repo;

    public function __construct()
    {
        $this->repo = new UserRepositories();
    }

    public function createUser(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            'profile_photo' => ['nullable', 'image']
        ];
        $customMessage = ['password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.'];

        $validator = Validator::make($request->all(), $rules, $customMessage);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }

        return $this->repo->createUser($request);
    }

}
