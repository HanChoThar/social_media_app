<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Aws\S3\Exception\S3Exception;
use Exception;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    
    public function uploadImage(Request $request)
    {
        $userId = $request->has('user_id') ? $request->input('user_id') : null;
        $dir = $request->has('dir') ? $request->input('dir') : 'images/';
        $image = $request->file('image');

        $storageName = pathinfo($image->hashName(), PATHINFO_FILENAME);
        $extension = $image->extension();
        $imageName = $image->getClientOriginalName();
        $size = $image->getSize();

        $createImage = Image::create([
            'name' => $storageName,
            'path' => 'https://'. config('filesystems.disks.s3.bucket').'.s3.'. config('filesystems.disks.s3.region') .'.amazonaws.com/',
            'folder' => $dir,
            'extension' => $extension,
            'image' => $imageName,
            'size' => $size,
            'thumbnail' => ''
        ]);

        $this->uploadFileToS3($dir, $image, $storageName, $extension);

        if($userId) {
           return $this->uploadUserProfileImage($userId, $createImage);
        }

    }

    public function uploadUserProfileImage($userId, $createImage)
    {
        $user = User::find($userId);
        if($user) {
            $user->profile_image_id = $createImage->id;
            $user->save();
        }

        return $user;
    }

    private function uploadFileToS3($folder, $file, $fileName, $extension)
    {
        $headers = [
            'visibility' => 'public',
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + (60 * 60 * 24 * 7)),
            'CacheControl' => 'max-age=315360000, no-transform, public',
        ];

        $dirExist = Storage::disk('s3')->exists($folder);
        if(!$dirExist) {
            Storage::disk('s3')->makeDirectory($folder, 0755, true);
        }
        
        $storeFileName = $fileName.'.'.$extension;
        Storage::disk('s3')->putFileAs($folder, $file, $storeFileName, $headers);
    
    }
}
