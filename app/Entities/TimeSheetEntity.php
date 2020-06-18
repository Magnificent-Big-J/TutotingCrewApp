<?php
namespace App\Entities;

use Carbon\Carbon;

trait TimeSheetEntity {
    public static function start_session($job_request)
    {
      self::create([
          'start_date' => Carbon::now(),
          'job_request_id' => $job_request->id

      ]);
      return true;
    }
    public function stop_session()
    {
        $this->end_date = Carbon::now();
        $this->save();

        return $this;
    }
}
