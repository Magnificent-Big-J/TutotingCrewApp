<?php

namespace App\Entities;

use App\Notifications\JobAssigned;

trait JobEntity {
    private $code = 'JOB-TAC-';
    public function assignReference()
    {
        $this->job_reference = $this->generateReference();
        $this->save();

        return true;
    }
    public function assignATutor($user)
    {
        $this->user_id = $user->id;
        $this->save();
        $user->notify(new JobAssigned($this->job_reference));

        return true;
    }
    private function generateReference()
    {
        return $this->code . time();
    }
    public function changeJobStatus($status)
    {
        $this->status = $this->checkStatus($status);
        $this->save();

        return $this;
    }
    private function checkStatus($status)
    {
        switch ($status)
        {
            case 2:
                  $job_status = "Pending";
                break;
            case 3:
                  $job_status = "Accept";
                break;
            case 4:
                $job_status = "Decline";
                break;
            default :
                $job_status = "Complete";
        }
        return $job_status;
    }
}
