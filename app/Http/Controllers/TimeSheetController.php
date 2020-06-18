<?php

namespace App\Http\Controllers;

use App\JobRequest;
use App\TimeSheet;
use Illuminate\Http\Request;

class TimeSheetController extends Controller
{
    public function start_request_session(JobRequest $jobRequest)
    {
        TimeSheet::start_session($jobRequest);
        session()->flash('success', 'Successfully Started.');
    }
    public function stop_request_session(TimeSheet $timeSheet)
    {
        $timeSheet->stop_session();
        session()->flash('success', 'Successfully Stopped.');
    }

    public function destroy(TimeSheet $timeSheet)
    {
        $timeSheet->delete();
        session()->flash('success', 'Successfully Deleted.');
    }
}
