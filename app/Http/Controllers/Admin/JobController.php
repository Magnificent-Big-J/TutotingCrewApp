<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequestData;
use App\JobRequest;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(JobRequestData $request)
    {
        $request->saveData();
    }
    public function destroy(JobRequest $job)
    {
        $job->delete();

        session()->flash('success', 'Job is successfully deleted');
    }
    public function changTutor(JobRequest $job, User $user)
    {
        $job->assignATutor($user);

        session()->flash('success', 'Mentor is successfully assigned');
    }
    public function changeStatus(Request $request)
    {
        session()->flash('success', 'Request');
    }

}
