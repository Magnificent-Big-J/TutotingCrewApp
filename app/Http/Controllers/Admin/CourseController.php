<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Requests\CourseRequest;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Course::orderBy('name','ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = $request->saveCourse();

        return response()->json(['course'=> $course,
            'message'=>'Successfully Created'], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, Course $course)
    {
        $request->updateCourse($course);

        return response()->json(['course'=> $course,
            'Successfully Updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
