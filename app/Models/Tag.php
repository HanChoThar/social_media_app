<?php

namespace App\Models;

use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'name'];

    public function jobListings()
    {
        return $this->belongsToMany(jobListings::class, 'job_tags', 'job_post_id', 'tag_id')->using(JobTag::class);
    }
}
