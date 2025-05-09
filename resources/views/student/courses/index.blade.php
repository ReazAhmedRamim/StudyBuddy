@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available Courses</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('student.courses.enroll') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Course Code</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>
                        <input type="checkbox" name="course_ids[]" value="{{ $course->id }}"
                            {{ in_array($course->id, $enrolledCourseIds) ? 'checked disabled' : '' }}>
                    </td>
                    <td>{{ $course->course_code }}</td>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Enroll Selected Courses</button>
    </form>
</div>
@endsection
