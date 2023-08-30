<?php

namespace App\Models;

use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory, Uuids;

    protected $table = 'images';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = ['name', 'path', 'folder', 'extension', 'image', 'size', 'thumbnail'];

    public function user()
    {
       return $this->hasOne('App\Models\User', 'profile_image_id');
    }

}
