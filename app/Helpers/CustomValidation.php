<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

trait CustomValidation
{
    public function validateRequest(array $data, $rules = [], $customMessages = [])
    {
        $validator = Validator::make($data, $rules, $customMessages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }
}
