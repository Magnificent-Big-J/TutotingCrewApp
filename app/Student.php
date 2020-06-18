<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];
    public function jobRequest()
    {
        return $this->hasMany(JobRequest::class);
    }
}
