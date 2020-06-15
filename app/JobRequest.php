<?php

namespace App;

use App\Entities\JobEntity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use JobEntity;
    protected $guarded = [];
    protected $dates = ['job_date'];

    public function setJobDateAttribute($job_date)
    {
        $this->attributes['job_date'] = Carbon::parse($job_date);
    }
}
