<?php

namespace Tests\Unit;

use App\JobRequest;
use App\TimeSheet;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $this->assertCount(1,auth()->user()->unreadNotifications);
        $job_reqest->changeJobStatus(3);
        TimeSheet::start_session($job_reqest);
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
        $this->assertCount(1,auth()->user()->unreadNotifications);
        $job_reqest->changeJobStatus(3);
        TimeSheet::start_session($job_reqest);
        $this->assertDatabaseCount('time_sheets', 1);
        $timesheet = TimeSheet::find(1);
        $this->assertNull($timesheet->end_date);
        $timesheet->stop_session();
        $this->assertInstanceOf(Carbon::class, $timesheet->end_date);
    }
}
