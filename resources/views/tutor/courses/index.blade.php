@extends('tutor.master')

@section('content')
<div class="page-content">
    <h3>My Teaching Courses</h3>

    @foreach($courses as $course)
        <div class="card mb-3">
            <div class="card-header">
                <h5>{{ $course->title }}</h5>
            </div>
            <div class="card-body">
                <p>{{ $course->description }}</p>
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
                        <li>
                            <form method="POST" action="{{ route('tutor.quiz.update', $quiz->quiz_id) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="title" value="{{ $quiz->title }}" required>
                                <input type="text" name="description" value="{{ $quiz->description }}">
                                <input type="datetime-local" name="scheduled_date" value="{{ old('scheduled_date', $quiz->scheduled_date ?? '') }}" required>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
