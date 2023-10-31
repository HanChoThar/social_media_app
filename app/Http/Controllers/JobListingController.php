<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Repositories\JobListingRepositories;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    protected $jobRepo;

    public function __construct(JobListingRepositories $jobRepo)
    {
        $this->jobRepo = $jobRepo;
    }

    public function jobLists(Request $request)
    {
        return $this->jobRepo->showAllJobLists($request);
    }

    public function jobDetailById($jobId) 
    {
        return $this->jobRepo->showJobDetailById($jobId);
    }
}
