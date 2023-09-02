<?php

namespace App\Repositories;

use App\Helpers\AmazonS3;
use App\Models\User;
use App\Models\Image;

class UserRepositories
{
    public function __construct()
    {
        // 
    }

    public function createUser($request)
    {
        $profilePhoto = $request->has('profile_photo') ? $request->file('profile_photo') : null;
        $createImage = $this->createUserProfileImage($profilePhoto);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' =>$request->input('password'),
            'system_status' => 'active',
            'profile_image_id' => ($createImage) ? $createImage->id : null
        ]);

        return response()->json([
            'message' => 'User Created Successfully',
            'user' => $user
        ], 201);

    }

    public function createUserProfileImage($profilePhoto)
    {
        if($profilePhoto) {
            $storageName = pathinfo($profilePhoto->hashName(), PATHINFO_FILENAME);
            $extension = $profilePhoto->extension();
            $imageName = $profilePhoto->getClientOriginalName();
            $size = $profilePhoto->getSize();
            $folder = 'profile-photos';
    
            $image = Image::create([
                'name' => $storageName,
                'path' => 'https://'. config('filesystems.disks.s3.bucket').'.s3.'. config('filesystems.disks.s3.region') .'.amazonaws.com/',
                'folder' => $folder,
                'extension' => $extension,
                'image' => $imageName,
                'size' => $size,
                'thumbnail' => ''
            ]);

            AmazonS3::uploadFile($folder, $profilePhoto, $storageName, $extension);

            return $image;
        }
        return null;
    }
}
