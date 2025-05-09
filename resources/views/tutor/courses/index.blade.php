@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-primary"><i class="bx bx-book-reader"></i> My Created Courses</h2>

    @if($courses->isEmpty())
        <div class="alert alert-info" role="alert">
            You have not created any courses yet.
        </div>
    @else
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-primary h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $course->title }}</h5>
                            @if($course->class_timing)
                                <p class="card-text"><strong>Class Timing:</strong> {{ $course->class_timing }}</p>
                            @else
                                <p class="card-text text-muted"><em>No class timing set.</em></p>
                            @endif
                            <a href="{{ route('tutor.quiz.upload', ['course' => $course->id]) }}" class="btn btn-primary mt-3">Upload Quiz Questions</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
