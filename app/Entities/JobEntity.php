<?php

namespace App\Entities;

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

        return true;
    }
    private function generateReference()
    {
        return $this->code . time();
    }
}
