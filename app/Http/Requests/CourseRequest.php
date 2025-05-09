<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $courseId = $this->route('id'); // Changed from 'course' to 'id' to match controller parameter name

        return [
            'tutor_id' => 'nullable|integer|exists:users,id',
            'course_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'title' => 'nullable|string',
            'course_name' => 'nullable|string',
            'course_code' => [
                'required',
                'string',
                Rule::unique('courses', 'course_code')->ignore($courseId),
            ],
            'class_timing' => 'required|string',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'label' => 'nullable|string|max:100',
            'course_goals.*' => 'nullable'
        ];
    }
}
