<?php

namespace App\Models;

use App\Helpers\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use PhpParser\Node\Expr\FuncCall;

class Company extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [ 'name', 'company_email', 'logo_id', 'company_address', 'industry_id'];

    public function jobListings()
    {
        return $this->hasMany(JobListing::class, 'company_id');
    }
}
