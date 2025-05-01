@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Schedule</h2>

    @foreach ($courses as $course)
        <div class="card mb-3">
            <div class="card-header">
                <h3>{{ $course->title }}</h3>
            </div>
            <div class="card-body">
                <h4>Classes</h4>
                <ul>
                    @foreach ($course->classes as $class)
                        <li>
                            {{ $class->class_title }} - {{ \Carbon\Carbon::parse($class->scheduled_time)->format('M d, Y h:i A') }} (Duration: {{ $class->duration }} mins)
                        </li>
                    @endforeach
                </ul>

                <h4>Quizzes</h4>
                <ul>
                    @foreach ($course->quizzes as $quiz)
                        <li>
                            {{ $quiz->title }} - {{ \Carbon\Carbon::parse($quiz->scheduled_date)->format('M d, Y') }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
