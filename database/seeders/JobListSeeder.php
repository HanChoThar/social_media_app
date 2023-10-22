<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobListing;
use App\Models\Tag;
use Database\Factories\JobListingFactory;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JobListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $companies = Company::factory()->count(3)->create();

            foreach ($companies as $company) {
                $JobListings = JobListing::factory()->count(10)->create([
                    'company_id' => $company->id,
                ]);

                foreach($JobListings as $JobListing) {

                    $tagIds = Tag::pluck('id')->toArray();
                    $shuffledIds = collect($tagIds)->shuffle()->toArray();

                    $randomizedTagIds = array_slice($shuffledIds, 0, 2);
                    $JobListing->tags()->attach($randomizedTagIds);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            Log::info($e->getTraceAsString());
        }
        
    }
}
