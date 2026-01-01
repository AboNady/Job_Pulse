<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    // A curated list of realistic tech tags
    protected $tags = [
        'Laravel', 'PHP', 'Symfony', 'Python', 'Django', 'JavaScript', 'TypeScript', 
        'Node.js', 'React', 'Vue.js', 'Angular', 'Java', 'Spring Boot', 'C#', '.NET', 
        'Go-(Golang)', 'Rust', 'Ruby', 'Rails', 'Swift', 'Kotlin', 'Flutter', 'DevOps', 
        'AWS', 'Azure', 'Docker', 'Kubernetes', 'Terraform', 'Linux', 'SQL', 'NoSQL', 
        'Redis', 'GraphQL', 'Machine Learning', 'AI', 'Data Science', 'Cybersecurity', 
        'Blockchain', 'Web3', 'UI-UX', 'Product Management', 'Agile', 'Scrum', 'Remote', 
        'SaaS', 'E-commerce', 'Fintech', 'Healthtech', 'Edtech', 'Startup', 'Enterprise'
    ];

    public function definition(): array
    {
        return [
            // We use 'randomElement' here, but in the Seeder we will ensure uniqueness
            'name' => $this->faker->randomElement($this->tags),
        ];
    }
    
    // Helper to get all tags for the seeder
    public function getTagNames(): array 
    {
        return $this->tags;
    }
}