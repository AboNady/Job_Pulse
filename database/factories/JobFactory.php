<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        // 1. Logic to define Seniority vs Tech vs Role
        $seniority = $this->faker->randomElement(['Junior', 'Entry-Level', 'Mid-Level', 'Senior', 'Staff', 'Principal', 'Lead']);
        $tech = $this->faker->randomElement(['Laravel', 'PHP', 'React', 'Vue.js', 'Node.js', 'Python', 'Go', 'Java', 'AWS', 'DevOps']);
        $role = $this->faker->randomElement(['Developer', 'Engineer', 'Architect', 'Specialist', 'Manager']);

        $title = "$seniority $tech $role";

        // 2. Realistic Salary Logic (EGP)
        switch ($seniority) {
            case 'Junior': $base = rand(15, 30); break;
            case 'Entry-Level': $base = rand(10, 25); break;
            case 'Mid-Level': $base = rand(35, 60); break;
            case 'Senior': $base = rand(65, 100); break;
            case 'Staff': $base = rand(110, 150); break;
            case 'Principal': $base = rand(160, 220); break;
            case 'Lead': $base = rand(80, 130); break;
            default: $base = rand(40, 80);
        }
        $salaryString = number_format($base * 1000) . ' EGP';

        // 3. Location Logic
        $type = $this->faker->randomElement(['Full Time', 'Part Time', 'Contract', 'Remote']);
        $location = ($type === 'Remote') ? 'Remote' : $this->faker->randomElement(['Cairo, Egypt', 'Dubai, UAE', 'Berlin, DE', 'London, UK', 'Riyadh, KSA']);

        return [
            'employer_id' => Employer::factory(), // This gets overridden by recycle() in the seeder
            'title'       => $title,
            'description' => $this->faker->realText(2500),
            'location'    => $location,
            'salary'      => $salaryString,
            'type'        => $type,
            'posted_date' => $this->faker->dateTimeBetween('-45 days', 'now'),
            'closing_date'=> $this->faker->dateTimeBetween('now', '+45 days'),
            'url'         => $this->faker->url(),
            'logo'        => 'https://picsum.photos/100/100', // Or inherit from Employer
            'is_featured' => $this->faker->boolean(15),
        ];
    }
}