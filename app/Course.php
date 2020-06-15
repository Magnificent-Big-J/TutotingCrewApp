<?php

namespace App;

use App\Entities\CourseEntity;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use CourseEntity;

    const THRESHOLD = 100;
    const MINIMUM = 1;
    const FIRST_INCREMENT = 1.25;
    const SECOND_INCREMENT = 1.50;
    const THIRD_INCREMENT = 1.50;


    protected $guarded = [];
}
