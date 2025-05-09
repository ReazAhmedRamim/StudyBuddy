@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Courses</h2>

    @if($courses->isEmpty())
        <p>You are not enrolled in any courses yet.</p>
    @else
        <ul class="list-group">
            @foreach($courses as $course)
                <li class="list-group-item">
                    <h4>{{ $course->title }}</h4>
                    @if($course->class_timing)
                        <p><strong>Class Timing:</strong> {{ $course->class_timing }}</p>
                    @else
                        <p><em>No class timing set.</em></p>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
    @if($courses->isEmpty())
    <div class="alert alert-info" role="alert">
        You are not enrolled in any courses yet.
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
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

</div>
@endsection
