<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile; // <--- Import this
use Illuminate\Support\Facades\Storage; // <--- Import this

class CreateJobTest extends TestCase
{
    use RefreshDatabase;

public function test_authenticated_employer_can_create_a_job()
{
    // Arrange
    Storage::fake('public'); // fake the disk so we don't save real files
    
    $user = User::factory()->create();
    $employer = Employer::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->actingAs($user);
    
    // Act
    $response = $this->post(route('jobs.store'), [
        'title'        => 'Senior Laravel Developer',
        'description'  => 'Great Laravel job',
        'location'     => 'Remote',
        'salary'       => '50000',
        'type'         => 'Full-time',
        'posted_date'  => now()->toDateString(),
        'closing_date' => now()->addMonth()->toDateString(),
        'url'          => 'https://example.com',
        
        // FIX IS HERE: Create a fake image file
        'logo'         => UploadedFile::fake()->image('logo.png'), 
        
        'is_featured'  => false,
    ]);

    // Assert: job exists in database
    $this->assertDatabaseHas('jobs', [
        'title' => 'Senior Laravel Developer',
    ]);

    // Optional redirect assertion
    $response->assertRedirect(route('index'));
}
}
