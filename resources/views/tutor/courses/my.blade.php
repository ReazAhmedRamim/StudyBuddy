@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Courses</h2>

    @if($courses->isEmpty())
        <div class="alert alert-info" role="alert">
            You are not teaching any courses yet.
        </div>
    @else
        <div class="row">
            @foreach ($courses as $course)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm border-primary h-100 d-flex flex-column justify-content-between">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $course->title }}</h5>
                            @if($course->description)
                                <p class="card-text">{{ $course->description }}</p>
                            @endif
                            @if($course->instructor)
                                <p><strong>Instructor:</strong> {{ $course->instructor }}</p>
                            @endif
                            @if($course->duration)
                                <p><strong>Duration:</strong> {{ $course->duration }}</p>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('tutor.quiz.upload', ['course' => $course->id]) }}" 
                               class="btn btn-primary w-100">
                                Upload Quiz Questions
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
