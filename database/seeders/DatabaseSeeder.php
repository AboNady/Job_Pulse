<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Tag;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Import this

class DatabaseSeeder extends Seeder
{
    // Disable events (like the Pinecone Observer) during seeding to speed it up
    use WithoutModelEvents; 

    public function run(): void
    {
        // 1. Create Tags
        // We fetch the array from the factory to ensure we create exactly one of each unique tag
        $tagNames = (new \Database\Factories\TagFactory)->getTagNames();
        
        $tags = collect($tagNames)->map(function ($name) {
            return Tag::firstOrCreate(['name' => $name]);
        });

        $this->command->info('Tags created: ' . $tags->count());

        // 2. Create Employers (The "Pool")
        // We create 500 companies. The 10,000 jobs will be split among them.
        $this->command->info('Creating 500 Employers...');
        $employers = Employer::factory(500)->create();

        // 3. Create Jobs in Chunks
        $totalJobs = 10000;
        $chunkSize = 1000; // Create 1000 at a time to save RAM

        $this->command->info("Starting creation of {$totalJobs} jobs...");

        for ($i = 0; $i < ($totalJobs / $chunkSize); $i++) {
            
            Job::factory($chunkSize)
                ->recycle($employers) // Distribute these jobs randomly among the 500 employers
                ->create()
                ->each(function ($job) use ($tags) {
                    // Attach 1 to 4 random tags to each job
                    $job->tags()->attach($tags->random(rand(1, 4)));
                });

            $this->command->info("Batch " . ($i + 1) . " completed.");
        }

        $this->command->info("DONE! 10,000 Jobs created successfully.");
    }
}