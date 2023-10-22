<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [ 
            'company_id' => function () {
                return Company::inRandomOrder()->first()->id;
            },
            'title' => fake()->jobTitle(),
            'description' => fake()->sentence(),
        ];
    }
}
