<?php

/**use App\Models\Employer;
use App\Models\Job;

it('belongs to an employer', function () {
    //Arrange
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_id' => $employer->id,
    ]);


    //Act & Asset
    expect($job->employer->is($employer))->toBeTrue();

    //Assert
});
*/

namespace Tests\Unit;

use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_belongs_to_an_employer(): void
    {
        // Arrange
        $employer = Employer::factory()->create();
        $job = Job::factory()->create([
            'employer_id' => $employer->id,
        ]);

        // Act & Assert
        $this->assertTrue($job->employer->is($employer));
    }
    public function testCanHaveTags()
    {
        // Create a job instance using the factory
        $job = Job::factory()->create();

        // Tag the job
        $job->tag('Frontend');

        // Assert that the job has 1 tag
        $this->assertCount(1, $job->tags);
    }

    //test for job applications

    public function test_user_can_apply_to_a_job(): void
    {
        $user = User::factory()->create(); //create a user and a job
        $job = Job::factory()->create();

        $user->appliedJobs()->attach($job->id, ['applied_at' => now(), 'status' => 'pending']); 

        $this->assertTrue($user->appliedJobs->contains($job));
        $this->assertTrue($job->applicants->contains($user));
    }

}   

