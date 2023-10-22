<?php

namespace App\Models;

use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobListing extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [ 'company_id', 'title', 'description', 'tag_id'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'job_tags', 'job_post_id', 'tag_id')->using(JobTag::class);
    }

}
