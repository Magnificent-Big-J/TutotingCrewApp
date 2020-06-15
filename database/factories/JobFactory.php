<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\JobRequest;
use App\Student;
use Faker\Generator as Faker;

$factory->define(JobRequest::class, function (Faker $faker) {
    return [
        'student_id' => \factory(Student::class)->create()->id,
        'course_id' => \factory(Course::class)->create()->id,
        'job_hours' => rand(1,100),
    ];
});
