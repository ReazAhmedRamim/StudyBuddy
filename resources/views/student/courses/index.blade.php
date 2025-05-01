@extends('student.master')

@section('content')
<div class="page-content">
    <h3>My Enrolled Courses</h3>

    @foreach($courses as $course)
        <div class="card mb-3">
            <div class="card-header">
                <h5>{{ $course->title }}</h5>
            </div>
            <div class="card-body">
                <p>{{ $course->description }}</p>
                <p><strong>Instructor:</strong> {{ $course->instructor }}</p>
                <p><strong>Duration:</strong> {{ $course->duration }}</p>

                <h6>Class Schedule</h6>
                <ul>
                    @foreach($course->classes as $class)
                        <li>{{ $class->class_title }} - {{ $class->scheduled_time }} (Duration: {{ $class->duration }} mins)</li>
                    @endforeach
                </ul>

                <h6>Quizzes</h6>
                <ul>
                    @foreach($course->quizzes as $quiz)
                        <li>{{ $quiz->title }} - {{ $quiz->description }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
