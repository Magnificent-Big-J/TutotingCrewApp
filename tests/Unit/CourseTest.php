<?php

namespace Tests\Unit;

use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/

    public function admin_can_increase_course_hours()
    {
        $this->authenticateAdmin();
        $course = factory(Course::class)->create(['total_hours'=> 1.25]);
        $answer = $course->increaseHours(2);
        $this->assertTrue($answer);
        $this->assertEquals($course->total_hours, 2.75);
    }
    /** @test **/
    public function admin_cannot_increase_course_hours_above_threshold()
    {
        $this->authenticateAdmin();
        $course = factory(Course::class)->create(['total_hours'=> 1.25]);
        $answer = $course->increaseHours(200);
        $this->assertFalse($answer);
        $this->assertEquals($course->total_hours, 1.25);
    }
    /** @test **/

    public function admin_can_decrement_course_hours()
    {
        $this->authenticateAdmin();
        $course = factory(Course::class)->create(['total_hours'=> 1.25]);
        $answer = $course->increaseHours(2);
        $this->assertTrue($answer);
        $answer = $course->decreaseHours(1);
        $this->assertTrue($answer);
        $this->assertEquals($course->total_hours, 1.75);
    }
    /** @test **/
    public function admin_cannot_decrement_course_hours_below_minimum()
    {
        $this->authenticateAdmin();
        $course = factory(Course::class)->create(['total_hours'=> 1.25]);
        $answer = $course->increaseHours(2);
        $this->assertTrue($answer);
        $answer = $course->decreaseHours(10);
        $this->assertFalse($answer);
        $this->assertEquals($course->total_hours, 2.75);
    }
}
