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
                            <form action="{{ route('tutor.quiz.update', $quiz->quiz_id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PUT')
                                <input type="text" name="title" value="{{ $quiz->title }}" class="form-control me-2" required>
                                <input type="date" name="scheduled_date" value="{{ \Carbon\Carbon::parse($quiz->scheduled_date)->format('Y-m-d') }}" class="form-control me-2" required>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
