<?php

namespace Tests\Feature;

use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function can_create_course()
    {
        $this->authenticateAdmin();

        $response = $this->postJson(route('course.store'), $this->getCourseData());

        $response->assertStatus(201);
        $this->assertDatabaseHas('courses',
            [
                'name' => $this->getCourseData()['name']
            ]
        );
    }
    /** @test **/
    public function name_is_required()
    {

        $this->authenticateAdmin();
        $response = $this->postJson(route('course.store'),
            array_merge($this->getCourseData(), ['name'=> null]));

        $response->assertJsonValidationErrors('name');
        $this->assertDatabaseCount('courses', 0);
    }

    /** @test **/
    public function description_is_required()
    {
        $this->authenticateAdmin();
        $response = $this->postJson(route('course.store'),
            array_merge($this->getCourseData(), ['description'=> null]));

        $response->assertJsonValidationErrors('description');
        $this->assertDatabaseCount('courses', 0);
    }
    /** @test **/
    public function can_update_course()
    {
        $this->authenticateAdmin();
        $course = factory(Course::class)->create();

        $response = $this->putJson(route('course.update', $course->id), $this->getCourseData());
        $response->assertStatus(201);
        $course = Course::find(1);
        $this->assertEquals('PHP', $course->name);
    }


    private function getCourseData()
    {
        return [
            'name' => 'PHP',
            'description' => 'Serve Scripting language that helps you build dynamic website'
        ];
    }
}
