<?php

namespace App\Models;

use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'author_id', 'image_id', 'title', 'contents'];

    public function user() 
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function like()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
