<?php

namespace Tests\Feature;

use App\Course;
use App\JobRequest;
use App\Student;
use App\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;

    protected $faker;
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->faker = Factory::create();
    }
    /** @test **/
    public function admin_create_job()
    {
        $this->authenticateAdmin();
        $response = $this->post(route('job.store'), $this->getJobData());

        $response->assertStatus(200);
        $job = JobRequest::find(1);
        $this->assertDatabaseCount('job_requests', 1);
        $this->assertInstanceOf(Carbon::class, $job->job_date);
        $this->assertNotEmpty($job->job_reference);
    }
    /** @test **/
    public function can_delete_a_job()
    {
        $this->authenticateAdmin();
        $response = $this->post(route('job.store'), $this->getJobData());

        $response->assertStatus(200);
        $this->assertDatabaseCount('job_requests', 1);
        $job = JobRequest::find(1);
        $response = $this->delete(route('job.delete', $job->id));
        $response->assertSessionHas('success', 'Job is successfully deleted');
        $this->assertDatabaseCount('job_requests', 0);
    }
    /** @test */
    public function student_is_required()
    {
        $this->authenticateAdmin();
        $response = $this->post(route('job.store'),
            array_merge($this->getJobData(),['student_id' => null]));

        $response->assertSessionHasErrors('student_id');
        $this->assertDatabaseCount('job_requests', 0);
    }
    /** @test */
    public function course_is_required()
    {
        $this->authenticateAdmin();
        $response = $this->post(route('job.store'),
            array_merge($this->getJobData(),['course_id' => null]));

        $response->assertSessionHasErrors('course_id');
        $this->assertDatabaseCount('job_requests', 0);
    }
    /** @test */
    public function job_hours_is_required()
    {
        $this->authenticateAdmin();
        $response = $this->post(route('job.store'),
            array_merge($this->getJobData(),['job_hours' => null]));

        $response->assertSessionHasErrors('job_hours');
        $this->assertDatabaseCount('job_requests', 0);
    }


    private function getJobData()
    {
        $user = \factory(User::class)->create();
        $user->assignUserRole($user, 2);
        return [
            'student_id' => \factory(Student::class)->create()->id,
            'user_id' => $user->id,
            'course_id' => \factory(Course::class)->create()->id,
            'job_hours' => 4,
        ];
    }
}
