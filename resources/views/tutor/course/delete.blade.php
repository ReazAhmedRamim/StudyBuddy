@extends('tutor.master')

@section('content')
    <div class="page-content">
        <div class="container mt-5">
            <div class="card col-md-6 offset-md-3">
                <div class="card-body text-center">
                    <h4 class="mb-3 text-danger">Confirm Course Deletion</h4>
                    <p>Are you sure you want to delete the course:</p>
                    <h5 class="text-dark"><strong>{{ $course->course_title }}</strong></h5>

                    <form method="POST" action="{{ route('tutor.course.destroy', $course->id) }}">
                        @csrf
                        @method('DELETE')

                        <div class="mt-4">
                            <a href="{{ route('tutor.course.index') }}" class="btn btn-secondary me-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-danger">
                                Yes, Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
