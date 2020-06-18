<?php

namespace Tests\Feature;

use App\JobRequest;
use App\TimeSheet;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TimeSheetTest extends TestCase
{
    use RefreshDatabase;
    /** @test  **/
    public function tutor_start_a_session()
    {
        $this->authenticateTutor();
        $job_reqest = factory(JobRequest::class)->create();
        $job_reqest->assignReference();
        $this->assertNotEmpty($job_reqest->job_reference);
        $this->assertDatabaseCount('job_requests', 1);
        $job_reqest->assignATutor(auth()->user());
        $job_reqest->changeJobStatus(3);

        $response = $this->post(route('timesheet.start', $job_reqest->id));
        $response->assertStatus(200);
        $response->assertSessionHas('success', 'Successfully Started.');

        $this->assertDatabaseCount('time_sheets', 1);
        $this->assertNull(TimeSheet::find(1)->end_date);
    }
    /** @test  **/
    public function tutor_stop_a_session()
    {
        $this->authenticateTutor();
        $job_reqest = factory(JobRequest::class)->create();
        $job_reqest->assignReference();
        $this->assertNotEmpty($job_reqest->job_reference);
        $this->assertDatabaseCount('job_requests', 1);
        $job_reqest->assignATutor(auth()->user());
        $job_reqest->changeJobStatus(3);

        $response = $this->post(route('timesheet.start', $job_reqest->id));
        $response->assertStatus(200);
        $response->assertSessionHas('success', 'Successfully Started.');

        $timesheet = TimeSheet::find(1);
        $response = $this->post(route('timesheet.stop', $timesheet->id));
        $response->assertStatus(200);
        $response->assertSessionHas('success', 'Successfully Stopped.');

    }
    /** @test **/
    public function tutor_can_delete_session()
    {
        $this->authenticateTutor();
        $job_reqest = factory(JobRequest::class)->create();
        $job_reqest->assignReference();
        $this->assertNotEmpty($job_reqest->job_reference);
        $this->assertDatabaseCount('job_requests', 1);
        $job_reqest->assignATutor(auth()->user());
        $job_reqest->changeJobStatus(3);

        $response = $this->post(route('timesheet.start', $job_reqest->id));
        $response->assertStatus(200);
        $response->assertSessionHas('success', 'Successfully Started.');

        $timesheet = TimeSheet::find(1);
        $response = $this->delete(route('timesheet.delete', $timesheet->id));
        $response->assertStatus(200);
        $response->assertSessionHas('success', 'Successfully Deleted.');
    }
}
