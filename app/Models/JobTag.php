<?php

namespace App\Models;

use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class JobTag extends Pivot
{
    use HasFactory, SoftDeletes, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = ['job_post_id', 'tag_id'];
}
