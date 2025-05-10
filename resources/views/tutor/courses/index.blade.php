@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 bg-blue-50 min-h-screen">
    <h2 class="mb-8 text-3xl font-semibold text-blue-700"><i class="bx bx-book-reader"></i> My Created Courses</h2>

    @if($courses->isEmpty())
        <div class="bg-blue-100 border border-blue-300 text-blue-700 px-4 py-3 rounded mb-4" role="alert">
            You have not created any courses yet.
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($courses as $course)
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col justify-between hover:shadow-xl transition-shadow duration-300">
                    <div>
                        <h5 class="text-xl font-bold text-blue-900 mb-3">{{ $course->title }}</h5>
                        @if($course->class_timing)
                            <p class="text-blue-700 mb-5"><strong>Class Timing:</strong> {{ $course->class_timing }}</p>
                        @else
                            <p class="text-blue-500 italic mb-5">No class timing set.</p>
                        @endif
                    </div>
                    <a href="{{ route('tutor.quiz.upload', ['course' => $course->id]) }}" 
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-5 rounded shadow-md transition-colors text-center">
                        Upload Quiz Questions
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
