<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentRequestUpdate;
use App\Student;
use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\Contracts\DataTable;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('name', 'ASC')->get();

        return $students;
    }
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $request->saveStudent();
        session()->flash('success','Student Successfully Created.');

        return redirect()->route('student.view');
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequestUpdate $request, Student $student)
    {
        $request->updateStudent($student);

        session()->flash('success','Successfully Updated.');
        return redirect()->route('student.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(['message'=>'Student successfully deleted'],200);
    }
    public function studentView(Request $request)
    {
        if($request->ajax()) {
            $data = Student::latest()->get();

            return DataTables::of($data)
                ->addColumn('actions', function($data){
                    $url = route('student.edit', $data->id);
                    $button = '<a href="'.$url.'" class="edit btn btn-primary btn-sm">Edit</a>';

                    return $button;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.students.students');
    }
}
