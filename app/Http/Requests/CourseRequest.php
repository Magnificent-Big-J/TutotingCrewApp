<?php

namespace App\Http\Requests;

use App\Course;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:courses,' . $this->id,
            'description' => 'required|string|max:255'
        ];
    }
    public function saveCourse()
    {
        return Course::create($this->all());
    }
    public function updateCourse($course)
    {
        $course->update($this->all());
    }
}
