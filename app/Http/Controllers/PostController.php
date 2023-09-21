<?php

namespace App\Http\Controllers;

use App\Helpers\CustomValidation;
use App\Repositories\PostRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use CustomValidation;

    protected $repo;

    public function __construct()
    {
        $this->repo = new PostRepositories();    
    }

    public function createPost(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:500'],
            'content' => ['required'],
            'image_id' => ['nullable']
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->repo->createPost($request);
    }

    public function getAllPosts(Request $request) 
    {
        $rules = [
            'limit' => ['required'],
            'page' => ['required'],
        ]; 
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->repo->getAllPosts($request);
    }

    public function getPostById(Request $request) 
    {
        $rules = [
            'id' => ['required', 'string'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        return $this->repo->getPostById($request);
    }

    public function updatePost(Request $request)
    {
        $rules = [
            'title' => ['required', 'string', 'max:500'],
            'content' => ['required'],
            'image_id' => ['nullable']
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return $this->repo->createPost($request);
    }
}
