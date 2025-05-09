@extends('student.master')

@section('content')
    <div class="page-content">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h3>Available Courses</h3>
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            <p><strong>Instructor:</strong> {{ $course->instructor }}</p>
                            <p><strong>Duration:</strong> {{ $course->duration }}</p>
                            @if(in_array($course->id, $enrolledCourseIds))
                                <button class="btn btn-secondary" disabled>Enrolled</button>
                            @else
                                <form method="POST" action="{{ route('student.courses.enroll') }}">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="submit" class="btn btn-primary">Enroll</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
