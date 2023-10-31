<?php

namespace App\Repositories;

use App\Models\JobListing;

class JobListingRepositories
{
    public function showAllJobLists($request)
    {
        $jobLists = JobListing::all();
        return view('joblistings', [    
            'jobLists' => $jobLists
        ]);
    }

    public function showJobDetailById($jobId)
    {
        $jobList = JobListing::findOrFail($jobId);
        return view('jobDetail', ['job' => $jobList]);
    }
}
