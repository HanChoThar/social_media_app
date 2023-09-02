<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class AmazonS3
{
    public static function uploadFile($folder, $file, $fileName, $extension)
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