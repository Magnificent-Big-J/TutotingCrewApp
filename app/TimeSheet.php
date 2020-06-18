<?php

namespace App;

use App\Entities\TimeSheetEntity;
use Illuminate\Database\Eloquent\Model;

class TimeSheet extends Model
{
    use TimeSheetEntity;
    protected $fillable = ['start_date', 'end_date', 'job_request_id'];
    public function jobRequest()
    {
        return $this->belongsTo(JobRequest::class);
    }
}
